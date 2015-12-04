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
      INSERT INTO events (nom,date_de,date_fi,nbpl,price,priv,telorg,norg,nentr,
      partn,weborg,reg,adr,code_p,ville,pays,descript,bann,comm,nott,sujet,condi)
		  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ');

    // TODO: Need to bind the params
    $prep->bindParam(1, $data['nom']);
    $prep->bindParam(2, $data['date_de']);
    $prep->bindParam(3, $data['date_fi']);
    $prep->bindParam(4, $data['nbpl']);
    $prep->bindParam(5, $data['price']);
    $prep->bindParam(6, $data['priv']);
    $prep->bindParam(7, $data['telorg']);
    $prep->bindParam(8, $data['norg']);
    $prep->bindParam(9, $data['nentr']);
    $prep->bindParam(10, $data['partn']);
    $prep->bindParam(11, $data['weborg']);
    $prep->bindParam(12, $data['reg']);
    $prep->bindParam(13, $data['adr']);
    $prep->bindParam(14, $data['code_p']);
    $prep->bindParam(15, $data['ville']);
    $prep->bindParam(16, $data['pays']);
    $prep->bindParam(17, $data['descript']);
    $prep->bindParam(18, $data['bann']);
    $prep->bindParam(19, $data['comm']);
    $prep->bindParam(20, $data['nott']);
    $prep->bindParam(21, $data['sujet']);
    $prep->bindParam(22, $data['condi']);

    if ($prep->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
	}

}

?>
