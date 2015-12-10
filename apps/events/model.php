<?php

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
		  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ');

    // 
    $prep->bindParam(1, $data['nom']);
    $prep->bindParam(2, $data['date_debut']);
    $prep->bindParam(3, $data['date_fin']);
    $prep->bindParam(4, $data['capacite']);
    $prep->bindParam(5, $data['prix']);
    $prep->bindParam(6, $data['prive']);
    $prep->bindParam(7, $data['site_web']);
    $prep->bindParam(8, $data['region']);
    $prep->bindParam(9, $data['adresse']);
    $prep->bindParam(10, $data['code_postal']);
    $prep->bindParam(11, $data['ville']);
    $prep->bindParam(12, $data['pays']);
    $prep->bindParam(13, $data['description']);
    $prep->bindParam(14, $data['banniere']);
    $prep->bindParam(15, $data['mot_clef']);


    if ($prep->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
	}

}

?>
