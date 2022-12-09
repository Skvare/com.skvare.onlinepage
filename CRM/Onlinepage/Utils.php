<?php

use CRM_Onlinepage_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Onlinepage_Utils {

  /**
   * @return array
   */
  public static function getEvents() {
    $events = [];
    $query = "SELECT id, title, start_date, end_date
      FROM civicrm_event
      WHERE (is_template = 0 OR is_template IS NULL)";
    $eventsResult = CRM_Core_DAO::executeQuery($query);
    while ($eventsResult->fetch()) {
      $dates = $eventsResult->start_date ?? '';
      if (!empty($dates) && !empty($eventsResult->end_date)) {
        $dates .= ' - ';
      }
      $dates .= $eventsResult->end_date ?? '';
      $events[$eventsResult->id] = ' #' . $eventsResult->id . ' - ' . $eventsResult->title . '  (' . $dates . ')';
    }

    return $events;
  }

  /**
   * @return array|bool
   */
  public static function getContribtionPages() {
    $pages = CRM_Contribute_BAO_Contribution::buildOptions('contribution_page_id', 'get', []);
    foreach ($pages as $id => &$title) {
      $title = '#' . $id . ' - ' . $title;
    }

    return $pages;
  }
}
