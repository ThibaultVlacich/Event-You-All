<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "events".
 *
 * @package apps/events/admin
 * @author Louis Arbaretier
 * @version 0.1.0-dev-14-01-2016
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

  
  //---------------------------------GET THEME-----------------------------------------------------------------
    public function getAllThemes($from = 0, $number = 9999999) {
    $prep = $this->db->prepare('SELECT * FROM themes ORDER BY nom LIMIT :from, :number');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);
    $prep->execute();

    $themes = $prep->fetchAll(PDO::FETCH_ASSOC);

    return $themes;
  }
 public function nodisplayTheme($id) {
      $prep = $this->db->prepare('UPDATE themes SET afficher=0 WHERE id = :id');

        $prep->bindParam(':id', $id);
        $prep->execute();
        return 'deleted';
  }
  
  public function displayTheme($id) {
      $prep = $this->db->prepare('UPDATE themes SET afficher=1 WHERE id = :id');

        $prep->bindParam(':id', $id);
        $prep->execute();
        return 'ok';
  }
  
    public function getTheme($id) {
      $prep = $this->db->prepare('SELECT * FROM themes WHERE id=:id');

        $prep->bindParam(':id', $id);
        $prep->execute();
        return $prep->fetch(PDO::FETCH_ASSOC);
  }
  
    public function modTheme($id,$nom) {
      $prep = $this->db->prepare('UPDATE themes SET nom=:nom WHERE id = :id');

        $prep->bindParam(':id', $id);
        $prep->bindParam(':nom', $nom);
        $prep->execute();
        return 'ok';
  }
      public function addTheme($nom) {
      $prep = $this->db->prepare('INSERT INTO themes (nom,afficher) VALUES (:nom,1)');

        $prep->bindParam(':nom', $nom['nom']);
        $prep->execute();
        return 'ok';
  }

}
?>
