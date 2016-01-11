<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

require APPS_DIR.'events/model.php';

class EventsAdminModel extends EventsModel {


  /**
   * Obtenir la liste des événements (specifique à admin car prend aussi nom createur)
   */
  public function getAllEvents($from = 0, $number = 9999999, $order = 'date_debut', $asc = true, $where_clause = '') {
    $prep = $this->db->prepare('
      SELECT *
      FROM evenements
      '.$where_clause.'
      ORDER BY '.$order.' '.($asc ? 'ASC' : 'DESC').'
      LIMIT :from, :number
    ');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);
    $prep->execute();

    $events = $prep->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($events as &$event) {
      // Get theme linked for the event
      if (!empty($event['id_theme'])) {
        $prep = $this->db->prepare('SELECT * FROM themes WHERE id = :id_theme');

        $prep->bindParam(':id_theme', $event['id_theme']);
        $prep->execute();

        $event['theme'] = $prep->fetch(PDO::FETCH_ASSOC);
      }
      else{
           $event['theme']['nom'] = 'Aucun';
      }

      // Get type linked for the event
      if (!empty($event['id_type'])) {
        $prep = $this->db->prepare('SELECT * FROM types WHERE id = :id_type');

        $prep->bindParam(':id_type', $event['id_type']);
        $prep->execute();

        $event['type'] = $prep->fetch(PDO::FETCH_ASSOC);
      }
      else{
           $event['type']['nom'] = 'Aucun';
      }
      // Get creator linked for the event
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

  public function deleteEvent($id) {
      $prep = $this->db->prepare('DELETE FROM evenements WHERE id = :id');

        $prep->bindParam(':id', $id);
        $prep->execute();
        return 'deleted';
  
  }
  

}
?>
