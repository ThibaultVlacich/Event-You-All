<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app faq.
 *
 * @package apps/faq
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-14-12-2015
 */

class FaqModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  // Then add methods (can be named whatever you want)
  public function faq() {
    $prep = $this->db->prepare('
    SELECT *
    FROM faq ');

    $prep->execute();

    return $prep->fetchAll(PDO::FETCH_ASSOC);
  }
}

?>
