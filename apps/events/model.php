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
		  VALUES (:nom,:date_debut,:date_fin,:capacite,:prix,:prive,
      :site_web,:region,:adresse,:code_postal,:ville,:pays,:description,:banniere,:mot_clef)
    ');
	

    // remettre les bons champs (ceux du formulaire que l'on recupere et les date modifiées)  
	$prep->bindParam(':nom', $data['nom']);
    $prep->bindParam(':date_debut', $data['date_de']);
    $prep->bindParam(':date_fin', $data['date_fi']);
    $prep->bindParam(':capacite', $data['nbpl']);
    $prep->bindParam(':prix', $data['price']);
    $prep->bindParam(':prive', $date['priv']);
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

}

?>
