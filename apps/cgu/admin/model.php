<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

require APPS_DIR.'cgu/model.php';

class CguAdminModel extends CguModel {


  /**
   * obtenir Cgu
   */
   public function getCgu(){
     $prep = $this->db->prepare('
   SELECT *
   FROM cgu');
   $prep->execute();
   return $prep;
}

    /**
    * Update database
    */
    public function updateCgu(){
      $prep = $this->db->prepare('UPDATE cgu');
    }

   };
  /**
  *modify Cgu
  */
     public function modifycgu(){};




}
?>
