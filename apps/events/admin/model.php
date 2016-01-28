<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "events".
 *
 * @package apps/events/admin
 * @author Louis Arbaretier
 * @version 1.1.0-14-01-2016
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

  //---------------------------------GET TYPE-----------------------------------------------------------------
  public function getAllTypes($from = 0, $number = 9999999) {
    $prep = $this->db->prepare('SELECT * FROM types ORDER BY nom LIMIT :from, :number');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);

    $prep->execute();

    $themes = $prep->fetchAll(PDO::FETCH_ASSOC);

    return $themes;
  }

  public function nodisplayType($id) {
    $prep = $this->db->prepare('UPDATE types SET afficher=0 WHERE id = :id');

    $prep->bindParam(':id', $id);

    $prep->execute();

    return 'deleted';
  }

  public function displayType($id) {
    $prep = $this->db->prepare('UPDATE types SET afficher=1 WHERE id = :id');

    $prep->bindParam(':id', $id);

    $prep->execute();

    return 'ok';
  }

  public function getType($id) {
    $prep = $this->db->prepare('SELECT * FROM types WHERE id=:id');

    $prep->bindParam(':id', $id);

    $prep->execute();

    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function modType($id,$nom) {
    $prep = $this->db->prepare('UPDATE types SET nom=:nom WHERE id = :id');

    $prep->bindParam(':id', $id);
    $prep->bindParam(':nom', $nom);

    $prep->execute();

    return 'ok';
  }

  public function addType($nom) {
    $prep = $this->db->prepare('INSERT INTO types (nom,afficher) VALUES (:nom,1)');

    $prep->bindParam(':nom', $nom['nom']);

    $prep->execute();

    return 'ok';
  }

  //---------------------------------GET REGION-----------------------------------------------------------------
  public function getAllRegions($from = 0, $number = 9999999) {
    $prep = $this->db->prepare('SELECT * FROM regions ORDER BY nom LIMIT :from, :number');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);

    $prep->execute();

    $themes = $prep->fetchAll(PDO::FETCH_ASSOC);

    return $themes;
  }

  public function nodisplayRegion($id) {
    $prep = $this->db->prepare('UPDATE regions SET afficher=0 WHERE id = :id');

    $prep->bindParam(':id', $id);

    $prep->execute();

    return 'deleted';
  }

  public function displayRegion($id) {
    $prep = $this->db->prepare('UPDATE regions SET afficher=1 WHERE id = :id');

    $prep->bindParam(':id', $id);

    $prep->execute();

    return 'ok';
  }

  public function getRegion($id) {
    $prep = $this->db->prepare('SELECT * FROM regions WHERE id=:id');

    $prep->bindParam(':id', $id);

    $prep->execute();

    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function modRegion($id,$nom) {
    $prep = $this->db->prepare('UPDATE regions SET nom=:nom WHERE id = :id');

    $prep->bindParam(':id', $id);
    $prep->bindParam(':nom', $nom);

    $prep->execute();

    return 'ok';
  }

  public function addRegion($nom) {
    $prep = $this->db->prepare('INSERT INTO regions (nom,afficher) VALUES (:nom,1)');

    $prep->bindParam(':nom', $nom['nom']);

    $prep->execute();

    return 'ok';
  }
}
?>
