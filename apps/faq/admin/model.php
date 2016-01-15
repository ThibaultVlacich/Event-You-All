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
   SELECT question,reponse
   FROM faq');
   $prep->execute();
   return $prep->fetchAll(PDO::FETCH_ASSOC);





}

/**
*page modify
*/
public function modify(){

}
/**
*modify faq db
*/


public function getCompteur(){
  $prep = $this->db->prepare('
SELECT compteur
FROM faq');
$prep->execute();
return $prep->fetchAll(PDO::FETCH_ASSOC);
}

public function modifyConfirm(array $data ){
 $compteur =$this->db->prepare('
SELECT compteur
FROM faq');
$compteur->execute();
return $compteur;

foreach($compteur as $id){

  $prep = $this->db->prepare('UPDATE faq SET question=:question,reponse=:reponse');
  $prep->bindParam(':question', $data['text_modifyQ'.$id]);
  $prep->bindParam(':reponse', $data['text_modifyR'.$id]);

  $prep->execute();
  }

}
}



?>
