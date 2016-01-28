<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "faq".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-13-12-2015
 */

class FaqAdminModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  public function getAllFaq(){
    $prep = $this->db->prepare('
  SELECT *
  FROM faq ');

  $prep->execute();
  return $prep->fetchAll(PDO::FETCH_ASSOC);
}

  /**
   * fonction obtenir faq db
   */
   public function getFaq($id){
     $prep = $this->db->prepare('
   SELECT *
   FROM faq WHERE id=:id');

   $prep->bindParam(':id',$id);
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




public function modifyConfirm(array $data ){




  $prep = $this->db->prepare('UPDATE faq SET question=:question,reponse=:reponse WHERE id=:id');
  $prep->bindParam(':id',$data['id']);
  $prep->bindParam(':question', $data['text_modifyQ']);
  $prep->bindParam(':reponse', $data['text_modifyR']);

  $prep->execute();


}

public function add(){

}

public function confirmAdd($data){
  $prep = $this->db->prepare('INSERT INTO faq(question,reponse) VALUES (:question,:reponse)');
  $prep->bindParam(':question', $data['text_modifyQ']);
  $prep->bindParam(':reponse', $data['text_modifyR']);

  $prep->execute();

}
public function deleteFaq($id) {
  $prep = $this->db->prepare('DELETE FROM faq WHERE id = :id');

    $prep->bindParam(':id', $id);
    $prep->execute();
    return 'deleted';

}

}



?>
