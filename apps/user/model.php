<?php

class UserModel {

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
  			INSERT INTO users(nickname, password, firstname, lastname, date_naissance, date_inscription, sex, email, telephone, access, adresse, code_postal, ville)
  			VALUES (:nickname, :password, :firstname, :lastname, :date_naissance, :date_inscription, :sex, :email, :telephone, :access, :adresse, :code_postal, :ville)
  		');

      $prep->bindParam(':nickname', $data['pseudonyme']);
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

    /**
  	 * Finds a user in the database matching with $nickname and $password.
  	 *
  	 * @param string $nickname
  	 * @param string $password
  	 * @return array Information of the users found
  	 */
  	public function matchUser($nickname, $password) {
  		$prep = $this->db->prepare('
  			SELECT id, nickname, password, email, firstname, lastname, country, access
  			FROM users
  			WHERE (nickname = :nickname OR email = :nickname) AND password = :password
  		');

  		$prep->bindParam(':nickname', $nickname);
  		$prep->bindParam(':password', $password);

  		$prep->execute();

  		return $prep->fetch(PDO::FETCH_ASSOC);
  	}

}

?>
