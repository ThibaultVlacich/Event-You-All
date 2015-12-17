<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "Search".
 *
 * @package apps/nameoftheapp
 * @author Hugo Michard <hugomichard@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

class SearchModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  // Then add methods (can be named whatever you want)
}

?>
