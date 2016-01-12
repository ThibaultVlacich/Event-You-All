<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "faq".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

class FaqAdminModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }
  /**
   * fonction obtenir faq db
   */
   public function getFaq(){
     $prep = $this->db->prepare('
   SELECT *
   FROM faq');
   $prep->execute();
   return $prep->fetch(PDO::FETCH_ASSOC);



}

/**
*page modify
*/
public function modify(){

}
/**
*modify faq db
*/



public function modifyConfirm(array $data){

  $prep = $this->db->prepare('UPDATE faq SET faq=:faq');
  $prep->bindParam(':faq', $data['text_modify']);
  $prep->execute();

}
}



?>
