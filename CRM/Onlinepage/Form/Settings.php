<?php

use CRM_Onlinepage_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Onlinepage_Form_Settings extends CRM_Core_Form {

  /**
   * Build the form object.
   *
   * @throws \CiviCRM_API3_Exception
   * @throws \CRM_Core_Exception
   * @throws \API_Exception
   */
  public function buildQuickForm() {
    $this->add('select', 'onlinepage_event_id',
      ts('Event Page'),
      CRM_Event_PseudoConstant::event(),
      FALSE, ['class' => 'crm-select2', 'multiple' => 'multiple', 'placeholder' => ts('- any -')]
    );

    $this->add('select', 'onlinepage_contribution_page_id',
      ts('Contribution Page'),
      CRM_Contribute_PseudoConstant::contributionPage(),
      FALSE, ['class' => 'crm-select2', 'multiple' => 'multiple', 'placeholder' => ts('- any -')]
    );

    $this->add('wysiwyg', 'onlinepage_access_denied_message', ts('Message for Access denied'));

    $this->addButtons([
      [
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ],
    ]);
    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());

    // use settings as defined in default domain
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    $setDefaults = [];
    foreach ($this->getRenderableElementNames() as $elementName) {
      $setDefaults[$elementName] = $settings->get($elementName);
    }
    $this->setDefaults($setDefaults);
    parent::buildQuickForm();
  }

  /**
   * Process the form submission.
   */
  public function postProcess() {
    $values = $this->exportValues();

    // use settings as defined in default domain
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);

    foreach ($values as $k => $v) {
      if (strpos($k, 'onlinepage_') === 0) {
        $settings->set($k, $v);
      }
    }
    CRM_Core_Session::setStatus(E::ts('Setting updated successfully'));
    parent::postProcess();
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = [];
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }

    return $elementNames;
  }

}
