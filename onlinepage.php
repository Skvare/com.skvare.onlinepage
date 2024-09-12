<?php

require_once 'onlinepage.civix.php';
// phpcs:disable
use CRM_Onlinepage_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function onlinepage_civicrm_config(&$config) {
  _onlinepage_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function onlinepage_civicrm_install() {
  _onlinepage_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function onlinepage_civicrm_enable() {
  _onlinepage_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function onlinepage_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 */
function onlinepage_civicrm_navigationMenu(&$menu) {
  _onlinepage_civix_insert_navigation_menu($menu, 'Administer/Customize Data and Screens', array(
    'label' => E::ts('Restrict online pages'),
    'name' => 'restrict_online_page',
    'url' => 'civicrm/admin/onlinepagesetting',
    'permission' => 'administer CiviCRM',
    'operator' => '',
    'separator' => 0,
  ));
  _onlinepage_civix_navigationMenu($menu);
}

/**
 * Implementation of hook_civicrm_alterTemplateFile
 */
function onlinepage_civicrm_alterTemplateFile($formName, $form, $context, &$tplName) {
  if ($formName == 'CRM_Event_Form_Registration_Register') {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    $onlinePageEventIds = $settings->get('onlinepage_event_id');
    if (is_array($onlinePageEventIds) && in_array($form->getVar('_eventId'),
        $onlinePageEventIds) && !CRM_Utils_System::isUserLoggedIn()) {
      $tplName = 'AccessError.tpl';
    }
  }
  elseif ($formName == 'CRM_Contribute_Form_Contribution_Main') {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    $onlinePagecontributionIds = $settings->get('onlinepage_contribution_page_id');
    if (is_array($onlinePagecontributionIds) && in_array($form->getVar('_id'),
        $onlinePagecontributionIds) &&
      !CRM_Utils_System::isUserLoggedIn()) {
      $tplName = 'AccessError.tpl';
    }
  }

  if ($tplName == 'AccessError.tpl') {
    $config = CRM_Core_Config::singleton();
    if ($config->userFramework == 'WordPress') {
      $args = NULL;
      $id = $form->get('id');
      if ($id) {
        $args .= "&id=$id";
      }
      else {
        $gid = $form->get('gid');
        if ($gid) {
          $args .= "&gid=$gid";
        }
        else {
          // Setup Personal Campaign Page link uses pageId
          $pageId = $form->get('pageId');
          if ($pageId) {
            $component = $form->get('component');
            $args .= "&pageId=$pageId&component=$component&action=add";
          }
        }
      }

      $destination = NULL;
      if ($args) {
        // append destination so user is returned to form they came from after login
        $args = 'reset=1' . $args;
        $destination = CRM_Utils_System::url(CRM_Utils_System::currentPath(), $args, TRUE, NULL, FALSE, TRUE);
        $destination = urlencode($destination);
      }
      $loginURL = wp_login_url();
      $query = $destination ? '?redirect_to=' . $destination : NULL;
      $loginURL = $loginURL . $query;
    }
    else {
      $destination = $config->userSystem->getLoginDestination($form);
      $loginURL = $config->userSystem->getLoginURL($destination);

    }
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    $message = $settings->get('onlinepage_access_denied_message');

    if (trim(empty($message))) {
      $message = "<br/><br/><br/>You must be logged in to register. <a href='$loginURL'>Click here to log in</a>";
    }
    else {
      $message .= "<p><a href='$loginURL'>Click here to log in</a></p>";
    }
    $form->assign('online_page_access_message', $message);
  }
}
