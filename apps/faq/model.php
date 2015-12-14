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

  public function getFaq($faq_id) {
    $prep = $this->db->prepare('SELECT * FROM faq WHERE id = :faq_id');

    $prep->bindParam(':faq_id', $faq_id, PDO::PARAM_INT);
    $prep->execute();

    return $prep->fetch(PDO::FETCH_ASSOC);
  }
}

?>
