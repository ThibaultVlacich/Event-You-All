<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "groupes".
 *
 * @package apps/groupes
 * @author Alexis Dahan <alexis.dahan@isep.fr>
 * @version 0.1.0-dev-17-12-2015
 */

class GroupesModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  // Then add methods (can be named whatever you want)
}

?>
