<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-13-12-2015
 */

require APPS_DIR.'article/model.php';

class ArticleAdminModel extends ArticleModel {


  /**
   * Obtenir la liste des événements (specifique à admin car prend aussi nom createur)
   */
  public function getAllArticles($from = 0, $number = 9999999, $order = 'date_creation', $asc = true, $where_clause = '') {
    $prep = $this->db->prepare('
      SELECT *
      FROM articles
      '.$where_clause.'
      ORDER BY '.$order.' '.($asc ? 'ASC' : 'DESC').'
      LIMIT :from, :number
    ');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);
    $prep->execute();

    $events = $prep->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($events as &$event) {
     

      // Get event linked for the article
      if (!empty($event['id_evenement'])) {
        $prep = $this->db->prepare('SELECT * FROM evenements WHERE id = :id_e');

        $prep->bindParam(':id_e', $event['id_evenement']);
        $prep->execute();

        $event['evenement'] = $prep->fetch(PDO::FETCH_ASSOC);
      }
      else{
           $event['evenement']['nom'] = 'Aucun';
      }
      // Get creator linked for the article
      if (!empty($event['id_createur'])) {
        $prep = $this->db->prepare('SELECT * FROM users WHERE id = :id_crea');

        $prep->bindParam(':id_crea', $event['id_createur']);
        $prep->execute();

        $event['createur'] = $prep->fetch(PDO::FETCH_ASSOC);
      }
      else{
           $event['createur']['nickname'] = 'Aucun';
      }
    }

    return $events;
  }

 /* public function deleteEvent($id) {
      $prep = $this->db->prepare('DELETE FROM evenements WHERE id = :id');

        $prep->bindParam(':id', $id);
        $prep->execute();
        return 'deleted';
  
  }*/
  

}
?>
