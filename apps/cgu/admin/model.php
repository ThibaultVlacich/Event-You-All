<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

class CguAdminModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }
  /**
   * obtenir Cgu
   */
   public function getCgu(){
     $prep = $this->db->prepare('
   SELECT *
   FROM cgu');
   $prep->execute();
   return $prep->fetch(PDO::FETCH_ASSOC);

}




    /**
    * Update database
    */
    public function updateCgu(){
      $prep = $this->db->prepare('UPDATE cgu');
    }

   }
  /**
  *modify Cgu
  */



?>
