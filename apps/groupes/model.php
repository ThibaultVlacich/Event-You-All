<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "NAME OF THE APP".
 *
 * @package apps/nameoftheapp
 * @author Name of the author <author@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

// -> Need to replace here "Default" by the name of the app (capitalized)
class GroupesModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  // Then add methods (can be named whatever you want)
}

?>