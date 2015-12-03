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
		$prep = $bdd->prepare('
      INSERT INTO events (nom,mail,theme,type,date_de,time_de,date_fi,time_fi,nbpl,price,mcef,priv,gpadm,padm,telorg,blist,norg,nentr,partn,weborg,reg,adr,code_p,ville,pays,descript,bann,comm,nott,sujet,condi)
		  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ');

    // TODO: Need to bind the params

    if ($prep->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
	}

}

?>
