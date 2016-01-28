<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "about".
 *
 * @package apps/about/admin
 * @author Louis
 * @version 1.1.0-13-12-2015
 */

class AboutAdminModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  public function getAbout(){
    $prep = $this->db->prepare('SELECT *FROM about');
    $prep->execute();

    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function modifyConfirm(array $data){
    $prep = $this->db->prepare('UPDATE about SET about = :about');

    $prep->bindParam(':about', $data['text_modify']);

    $prep->execute();
  }
}
?>
