<?php

class EventsModel {

  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }


  	/**
  	 * Creates a user in the database.
  	 *
  	 * @param array $data
  	 * @return mixed ID of the user just created or false on failure
  	 */
  	public function createUser(array $data) {
  		$prep = $this->db->prepare('
  			INSERT INTO users(pseudonyme, password, firstname, lastname, date_naissance, date_inscription, sex, email, telephone, access, adresse, code_postal, ville)
  			VALUES (:pseudonyme, :password, :firstname, :lastname, :date_naissance, :date_inscription, :sex, :email, :telephone, :access, :adresse, :code_postal, :ville)
  		');

      $prep->bindParam(':pseudonyme', $data['pseudonyme']);
      $prep->bindParam(':password', $data['password']);
      $prep->bindParam(':firstname', $data['firstname']);
      $prep->bindParam(':lastname', $data['lastname']);
      $prep->bindParam(':date_naissance', $date['date_naissance']);
      $prep->bindParam(':date_inscription', $date['date_inscription']);
      $prep->bindParam(':sex', $data['sex']);
      $prep->bindParam(':email', $data['email']);
      $prep->bindParam(':telephone', $data['telephone']);
      $prep->bindParam(':access', 1);
      $prep->bindParam(':adresse', $data['adresse']);
      $prep->bindParam(':code_postale', $date['code_postale']);
      $prep->bindParam(':ville', $date['ville']);

      if ($prep->execute()) {
        return $this->db->lastInsertId();
      } else {
        return false;
      }

  	}
	/*
	 *Create event in database
	
	*/
	public function createevent()
	{
		if (!in_array(null,$data,true))
		{
			
			$req=$bdd->prepare('INSERT INTO events (nom,mail,theme,type,date_de,time_de,date_fi,time_fi,nbpl,price,mcef,priv,gpadm,padm,telorg,
			blist,norg,nentr,partn,weborg,reg,adr,code_p,ville,pays,descript,bann,comm,nott,sujet,condi)
			    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
			$data=Request::getAssoc(array('nom','mail','theme','type','date_de','time_de',
			'date_fi','time_fi','nbpl','price','mclef','priv','gpadm','padm','telorg',
			'blist','norg','nentr','partn','weborg','reg'
			,'adr','code_p','ville','pays','descript'
			,'bann','comm','nott','sujet','condi'))
			
		}
	}
		/*
	 if ( isset($_POST['nom']) and isset($_POST['mail']) and isset($_POST['theme'])
			and isset($_POST['type']) and isset($_POST['date_de']) and isset($_POST['time_de'])
		and isset($_POST['date_fi']) and isset($_POST['time_fi']) and isset($_POST['nbpl']) and isset($_POST['price'])
		and isset($_POST['mclef']) and isset($_POST['priv']) and isset($_POST['gpadm']) and isset($_POST['padm']) and isset($_POST['telorg'])
		and isset($_POST['blist']) and isset($_POST['norg']) and isset($_POST['nentr']) and isset($_POST['partn']) and isset($_POST['weborg'])
		and isset($_POST['reg']) and isset($_POST['adr']) and isset($_POST['code_p']) and isset($_POST['ville']) and isset($_POST['pays'])	
		and isset($_POST['descript']) and isset($_POST['bann']) and isset($_POST['comm']) and isset($_POST['nott']) and isset($_POST['sujet'])
		and isset($_POST['condi']))
		{
			$bdd=new PDO('mysql:host=localhost;dbname=event_you_all','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			$req=$bdd->prepare('INSERT INTO events (nom,mail,theme,type,date_de,time_de,date_fi,time_fi,nbpl,price,mcef,priv,gpadm,padm,telorg,
			blist,norg,nentr,partn,weborg,reg,adr,code_p,ville,pays,descript,bann,comm,nott,sujet,condi)
			    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
			$req->execute(array($_POST['nom'],$_POST['mail'],$_POST['theme'],$_POST['type'],$_POST['date_de'],$_POST['time_de'],
			$_POST['date_fi'],$_POST['time_fi'],$_POST['nbpl'],$_POST['price'],$_POST['mclef'],$_POST['priv'],$_POST['gpadm'],$_POST['padm'],$_POST['telorg'],
			$_POST['blist'],$_POST['norg'],$_POST['nentr'],$_POST['partn'],$_POST['weborg'],$_POST['reg']
			,$_POST['adr'],$_POST['code_p'],$_POST['ville'],$_POST['pays'],$_POST['descript']
			,$_POST['bann'],$_POST['comm'],$_POST['nott'],$_POST['sujet'],$_POST['condi'])); 
			//echo('Evenement Créé');
		}
		else{
			//echo('Erreur de Merde !');
		}*/


}

?>
