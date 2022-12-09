<?php

use CRM_Onlinepage_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Onlinepage_Utils {

  static function getEvents() {
    $events = [];
    $query = "SELECT id, title
      FROM civicrm_event
      WHERE (is_template = 0 OR is_template IS NULL)
      AND (start_date > NOW() OR end_date > NOW() OR end_date IS NULL)
    ";
    $eventsResult = CRM_Core_DAO::executeQuery($query);
    while ($eventsResult->fetch()) {
      $events[$eventsResult->id] = $eventsResult->title;
    }

    return $events;
  }
}
