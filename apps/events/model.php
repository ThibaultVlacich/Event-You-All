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
      site_web,region,adresse,code_postal,ville,pays,description,banniere,mot_clef)
		  VALUES (:nom,:date_debut,:date_fin,:capacite,:prix,:prive,
      :site_web,:region,:adresse,:code_postal,:ville,:pays,:description,:banniere,:mot_clef)
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
    $prep->bindParam(':banniere', $data['bann']);
    $prep->bindParam(':mot_clef', $data['mclef']);

    if ($prep->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
	}
	public function getEvent($event_id){
		$prep = $this->db->prepare('SELECT * FROM evenements WHERE id='.$event_id.'');
		$coco= $prep->fetch(PDO::FETCH_ASSOC);
		return $coco;
	}

}

?>
