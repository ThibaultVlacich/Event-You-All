<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "events".
 *
 * @package apps/events
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 0.1.0-dev-11-12-2015
 */

class EventsModel {

  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }


  /**
   * Creates an event in the database.
   *
   * @param array $data
   * @return mixed ID of the event just created or false on failure
   */
  public function createEvent(array $data) {
    $prep = $this->db->prepare('
      INSERT INTO evenements (nom,date_debut,date_fin,capacite,prix,prive,
      site_web,region,adresse,code_postal,ville,pays,description,banniere,mot_clef,id_createur,poster,id_type,id_theme)
      VALUES (:nom,:date_debut,:date_fin,:capacite,:prix,:prive,
      :site_web,:region,:adresse,:code_postal,:ville,:pays,:description,:banniere,:mot_clef,:creator,:poster,:type,:theme)
    ');

    //prend l'id utilisateur
	  $session = System::getSession();
	  if ($session->isConnected()) {
	    $user_id = $_SESSION['userid'];
	  }
    $prep->bindParam(':nom', $data['nom']);
    $prep->bindParam(':date_debut', $data['date_de']);
    $prep->bindParam(':date_fin', $data['date_fi']);
    $prep->bindParam(':capacite', $data['nbpl']);
    $prep->bindParam(':prix', $data['price']);
    $prep->bindParam(':prive', $data['priv']);
    $prep->bindParam(':site_web', $data['weborg']);
    $prep->bindParam(':region', $data['reg']);
    $prep->bindParam(':adresse', $data['adr']);
    $prep->bindParam(':code_postal', $data['code_p']);
    $prep->bindParam(':ville', $data['ville']);
    $prep->bindParam(':pays', $data['pays']);
    $prep->bindParam(':description', $data['descript']);
    $prep->bindParam(':banniere', $data['bann']);
    $prep->bindParam(':poster', $data['poster']);
    $prep->bindParam(':mot_clef', $data['mclef']);
    $prep->bindParam(':creator',$user_id);
    $prep->bindParam(':type', $data['type']);
    $prep->bindParam(':theme',$data['theme']);


    if ($prep->execute()) {
	    $idevent = $this->db->lastInsertId('id');



      return $idevent;
    } else {
      return false;
    }
  }

  public function getEvent($event_id) {
    $prep = $this->db->prepare('SELECT * FROM evenements WHERE id = :event_id');

    $prep->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $prep->execute();

    $event = $prep->fetch(PDO::FETCH_ASSOC);

    if ($event !== false) {
      // Get theme linked for the event
      if (!empty($event['id_theme'])) {
        $prep = $this->db->prepare('SELECT * FROM themes WHERE id = :id_theme');

        $prep->bindParam(':id_theme', $event['id_theme']);
        $prep->execute();

        $event['theme'] = $prep->fetch(PDO::FETCH_ASSOC);
      }

      // Get type linked for the event
      if (!empty($event['id_type'])) {
        $prep = $this->db->prepare('SELECT * FROM types WHERE id = :id_type');

        $prep->bindParam(':id_type', $event['id_type']);
        $prep->execute();

        $event['type'] = $prep->fetch(PDO::FETCH_ASSOC);
      }
    }

    return $event;
  }

  /**
   * Obtenir la liste des événements
   */
  public function getEvents($from = 0, $number = 9999999, $order = 'date_debut', $asc = true, $where_clause = '') {
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

      // Get type linked for the event
      if (!empty($event['id_type'])) {
        $prep = $this->db->prepare('SELECT * FROM types WHERE id = :id_type');

        $prep->bindParam(':id_type', $event['id_type']);
        $prep->execute();

        $event['type'] = $prep->fetch(PDO::FETCH_ASSOC);
      }
    }

    return $events;
  }

  public function getArticlesForEvent($event_id) {
    $prep = $this->db->prepare('SELECT * FROM articles WHERE id_evenement = :event_id');

    $prep->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $prep->execute();

    return $prep->fetchAll(PDO::FETCH_ASSOC);
  }

  //recuperer l'id lié au createur
  public function getCreator($creator_id) {
    $prep = $this->db->prepare('SELECT * FROM users WHERE id = :creator_id');
    $prep->bindParam(':creator_id', $creator_id, PDO::PARAM_INT);
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function getPosterBannerForEvent($event_id) {
    $prep = $this->db->prepare('SELECT evenements.poster,evenements.banniere, evenements.id FROM evenements WHERE  evenements.id = '.$event_id.'');
    $prep->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }

public function modifEvent(array $data) {
    $prep = $this->db->prepare('
      UPDATE evenements SET nom=:nom,capacite=:capacite,prix=:prix,prive=:prive,
      site_web=:site_web,region=:region,adresse=:adresse,code_postal=:code_postal,ville=:ville,pays=:pays,description=:description,
      mot_clef=:mot_clef,date_debut=:date_debut,date_fin=:date_fin,banniere=:banniere,poster=:poster,id_type=:type,id_theme=:theme WHERE id = :id_event
    ');

    $prep->bindParam(':nom', $data['nom']);
    $prep->bindParam(':date_debut', $data['date_de']);
    $prep->bindParam(':date_fin', $data['date_fi']);
    $prep->bindParam(':capacite', $data['nbpl']);
    $prep->bindParam(':prix', $data['price']);
    $prep->bindParam(':prive', $data['priv']);
    $prep->bindParam(':site_web', $data['weborg']);
    $prep->bindParam(':region', $data['reg']);
    $prep->bindParam(':adresse', $data['adr']);
    $prep->bindParam(':code_postal', $data['code_p']);
    $prep->bindParam(':ville', $data['ville']);
    $prep->bindParam(':pays', $data['pays']);
    $prep->bindParam(':description', $data['descript']);
    $prep->bindParam(':mot_clef', $data['mclef']);
    $prep->bindParam(':id_event', $data['id']);
    $prep->bindParam(':banniere', $data['bann']);
    $prep->bindParam(':poster', $data['poster']);
    $prep->bindParam(':theme', $data['theme']);
    $prep->bindParam(':type', $data['type']);

    if ($prep->execute()) {
      return $data['id'];
    } else {
      return false;
    }
  }

  public function getThemes(){
    $prep = $this->db->prepare('SELECT * FROM themes');

    $prep->execute();

    $events = $prep->fetchAll(PDO::FETCH_ASSOC);

    return $events;
  }

  public function getTypes(){
    $prep = $this->db->prepare('SELECT * FROM types');

    $prep->execute();

    $events = $prep->fetchAll(PDO::FETCH_ASSOC);

    return $events;
  }

  public function getRegions(){
    $prep = $this->db->prepare('SELECT * FROM regions');

    $prep->execute();

    $events = $prep->fetchAll(PDO::FETCH_ASSOC);

    return $events;
  }

  public function isCurrentUserRegisteredToEvent($id_event) {
    $session = System::getSession();

	  if ($session->isConnected()) {
	    $id_user = $_SESSION['userid'];
	  }

    $prep = $this->db->prepare('
      SELECT * FROM evenements_participants
      WHERE id_evenement = :id_event AND id_utilisateur = :id_user
    ');

    $prep->bindParam(':id_event', $id_event, PDO::PARAM_INT);
    $prep->bindParam(':id_user', $id_user, PDO::PARAM_INT);

    $prep->execute();

    return ($prep->rowCount() > 0);
  }

  public function registerUserToEvent($id_event) {
    $session = System::getSession();

	  if (!$session->isConnected()) {
      return;
    }

	  $id_user = $_SESSION['userid'];

    $prep = $this->db->prepare('
      INSERT INTO evenements_participants
      (id_evenement, id_utilisateur)
      VALUES (:id_event, :id_user)
    ');

    $prep->bindParam(':id_event', $id_event, PDO::PARAM_INT);
    $prep->bindParam(':id_user', $id_user, PDO::PARAM_INT);

    $prep->execute();
  }

  public function unregisterUserToEvent($id_event) {
    $session = System::getSession();

    if (!$session->isConnected()) {
      return;
    }

	  $id_user = $_SESSION['userid'];

    $prep = $this->db->prepare('
      DELETE FROM evenements_participants
      WHERE id_evenement = :id_event AND id_utilisateur = :id_user
    ');

    $prep->bindParam(':id_event', $id_event, PDO::PARAM_INT);
    $prep->bindParam(':id_user', $id_user, PDO::PARAM_INT);

    $prep->execute();
  }

  public function numberOfParticipants($id_event) {
    $prep = $this->db->prepare('SELECT * FROM `evenements_participants` WHERE id_evenement = :id_event');

    $prep->bindParam(':id_event', $id_event, PDO::PARAM_INT);

    $prep->execute();

    return $prep->rowCount();
  }
    public function deleteEvent($id) {
      $prep = $this->db->prepare('DELETE FROM evenements WHERE id = :id');

        $prep->bindParam(':id', $id);
        $prep->execute();
        return 'deleted';
  
  }

}
?>
