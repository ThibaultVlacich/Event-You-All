<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "cgu".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

class AboutModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }
  /**
   * fonction obtenir Cgu db
   */
   public function cgu(){
     $prep = $this->db->prepare('
   SELECT *
   FROM about');
   $prep->execute();
   return $prep->fetch(PDO::FETCH_ASSOC);



}

}



?>
