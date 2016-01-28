<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "cgu".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-13-12-2015
 */

class CguAdminModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }
  /**
   * fonction obtenir Cgu db
   */
   public function getCgu(){
     $prep = $this->db->prepare('
   SELECT *
   FROM cgu');
   $prep->execute();
   return $prep->fetch(PDO::FETCH_ASSOC);



}

/**
*page modify
*/
public function modify(){

}
/**
*modify Cgu db
*/



public function modifyConfirm(array $data){

  $prep = $this->db->prepare('UPDATE cgu SET cgu=:cgu');
  $prep->bindParam(':cgu', $data['text_modify']);
  $prep->execute();

}
}



?>
