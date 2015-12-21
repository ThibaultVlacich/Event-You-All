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
      site_web,region,adresse,code_postal,ville,pays,description,banniere,mot_clef,id_createur,poster)
      VALUES (:nom,:date_debut,:date_fin,:capacite,:prix,:prive,
      :site_web,:region,:adresse,:code_postal,:ville,:pays,:description,:banniere,:mot_clef,:creator,:poster)
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

    if ($prep->execute()) {
	    $idevent = $this->db->lastInsertId('id');

	    // lier le type de l'event
	    $prep = $this->db->prepare('INSERT INTO evenements_types (id_evenement, id_type) VALUES (:id_ev, :id_ty)');
	    $prep->bindParam(':id_ev', $idevent);
      $prep->bindParam(':id_ty', $data['type']);
	    $prep->execute();

	    // lier le theme de l'event
	    $prep = $this->db->prepare('INSERT INTO evenements_genres (id_evenement, id_genre) VALUES (:id_ev, :id_ge)');
	    $prep->bindParam(':id_ev', $idevent);
      $prep->bindParam(':id_ge', $data['theme']);
	    $prep->execute();

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

    return $event;
  }

  /**
   * Obtenir la liste des événements
   */
  public function getEvents($from = 0, $number = 9999999, $order = 'date_debut', $asc = true) {
    $prep = $this->db->prepare('
      SELECT *
      FROM evenements
      ORDER BY '.$order.' '.($asc ? 'ASC' : 'DESC').'
      LIMIT :from, :number
    ');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);
    $prep->execute();

    return $prep->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getArticlesForEvent($event_id) {
    $prep = $this->db->prepare('SELECT * FROM articles WHERE id_evenement = :event_id');

    $prep->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $prep->execute();

    return $prep->fetchAll(PDO::FETCH_ASSOC);
  }

  //recuperer l'id lié au createur
  public function getCreatorForEvent($event_id) {
    $prep = $this->db->prepare('SELECT users.nickname, users.id FROM users INNER JOIN evenements ON  users.id = evenements.id_createur');
    $prep->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }


public function modifEvent(array $data) {
    $event_id = intval($params[0]);
    $prep = $this->db->prepare('
      UPDATE evenements (nom,capacite,prix,prive,
      site_web,region,adresse,code_postal,ville,pays,description,mot_clef)
      VALUES (:nom,:capacite,:prix,:prive,
      :site_web,:region,:adresse,:code_postal,:ville,:pays,:description,:mot_clef) WHERE id = :event_id
    ');

    $prep->bindParam(':nom', $data['nom']);
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
//TO DO mofify poster and banner only if changed !
//      modify date
    if ($prep->execute()) {
/*
        // lier le type de l'event
        $prep = $this->db->prepare('INSERT INTO evenements_types (id_evenement, id_type) VALUES (:id_ev, :id_ty)');
        $prep->bindParam(':id_ev', $idevent);
      $prep->bindParam(':id_ty', $data['type']);
        $prep->execute();

        // lier le theme de l'event
        $prep = $this->db->prepare('INSERT INTO evenements_genres (id_evenement, id_genre) VALUES (:id_ev, :id_ge)');
        $prep->bindParam(':id_ev', $idevent);
      $prep->bindParam(':id_ge', $data['theme']);
        $prep->execute();
*/
        echo 'ok';
      return $event_id;
    } else {
        echo 'non';
      return false;
    }
  }
}
?>
