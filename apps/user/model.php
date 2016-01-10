<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "User".
 *
 * @package apps/user
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-03-12-2015
 */

class UserModel {

  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  /**
   * Checks whether a nickname is valid and available
   *
   * @param string $nickname
   * @return mixed true if valid or error string
   */
  public function checkNickname($nickname) {
    if (empty($nickname) || strlen($nickname) < 3 || strlen($nickname) > 200) {
      return 'Le pseudonyme n\'est pas assez long.';
    } else if (!Tools::isEmail($nickname) && preg_match('#[\.]+#', $nickname)) {
      return 'Le pseudonyme contient des caractères incorrects.';
    }

    $prep = $this->db->prepare('
      SELECT * FROM users WHERE nickname LIKE :nickname
    ');

    $prep->bindParam(':nickname', $nickname);

    $prep->execute();

    if ($prep->rowCount() == 0) {
      return true;
    } else {
      return 'Ce pseudonyme est déjà utilisé.';
    }
  }

  /**
   * Checks whether an email is valid and available
   *
   * @param string $email
   * @return mixed true if valid or error string
   */
  public function checkEmail($email) {
    if (!Tools::isEmail($email)) {
      return 'L\'email saisi est invalide.';
    }

    $prep = $this->db->prepare('
      SELECT * FROM users WHERE email LIKE :email
    ');

    $prep->bindParam(':email', $email);

    $prep->execute();

    if ($prep->rowCount() == 0) {
      return true;
    } else {
      return 'L\'email saisi est déjà utilisé.';
    }
  }

  /**
   * Retrieves informations about for specific user.
   *
   * @param int $user_id ID of the user
   * @return array Information about the user
   */
  public function getUser($user_id) {
    $prep = $this->db->prepare('
      SELECT *
      FROM users
      WHERE id = :userid
    ');

    $prep->bindParam(':userid', $user_id, PDO::PARAM_INT);

    $prep->execute();

    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Creates a user in the database.
   *
   * @param array $data
   * @return mixed ID of the user just created or false on failure
   */
  public function createUser(array $data) {
    $prep = $this->db->prepare('
      INSERT INTO users(nickname, email, password, firstname, lastname, register_date, phone, adress, zip_code, city, country)
      VALUES (:nickname, :email, :password, :firstname, :lastname, NOW(), :phone, :adress, :zip_code, :city, :country)
    ');

    $prep->bindParam(':nickname', $data['nickname']);
    $prep->bindParam(':email', $data['email']);
    $prep->bindParam(':password', $data['password']);
    $prep->bindParam(':firstname', $data['firstname']);
    $prep->bindParam(':lastname', $data['lastname']);
    $prep->bindParam(':phone', $data['phone']);
    $prep->bindParam(':adress', $data['adress']);
    $prep->bindParam(':zip_code', $data['zip_code']);
    $prep->bindParam(':city', $data['city']);
    $prep->bindParam(':country', $data['country']);

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
      SELECT id, nickname, password, email, firstname, lastname, access
      FROM users
      WHERE (nickname = :nickname OR email = :nickname) AND password = :password
    ');

    $prep->bindParam(':nickname', $nickname);
    $prep->bindParam(':password', $password);

    $prep->execute();

    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function checkIfMailIsInDatabase($mail){
    $prep = $this->db->prepare('SELECT * FROM users WHERE email LIKE :email');

    $prep->bindParam(':email', $mail);

    $prep->execute();

    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function generateNewPasswordForUser($user_id) {
    $prep = $this->db->prepare('UPDATE users SET password = :newpassword WHERE id = :user_id');

    // This generates a new random password that will be sent back to the user.
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $newpassword = substr( str_shuffle( $chars ), 0, 8 );
    $newpassword_hashed = sha1($newpassword);

    $prep->bindParam(':newpassword', $newpassword_hashed);
    $prep->bindParam(':user_id', $user_id);

    $prep->execute();

    return $newpassword;
  }

  public function changeprofil($modifications, $user_id) {
     $changes = 'UPDATE users SET ';

     if(!empty($modifications['photoprofil'])) {
       $changes .= 'photoprofil = "'.addslashes($modifications['photoprofil']).'" ';
     }

     if(!empty($modifications['commentaire'])) {
       if(strlen($changes)>17) {//the , is only add if a field has already been add to $changes.
         $changes .=', ';
       }
       $changes .= 'commentaire = "'.addslashes($modifications['commentaire']).'" ';
     }

     if(!empty($modifications['profilprive'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'profilprive = '.intval($modifications['profilprive']);
     }

     if(!empty($modifications['birthdate'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'birthdate = "'.intval($modifications['birthdate']).'" ';
     }

     if(!empty($modifications['sex'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'sex = "'.addslashes($modifications['sex']).'" ';
     }

     if(!empty($modifications['adress'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'adress = "'.addslashes($modifications['adress']).'" ';
     }

     if(!empty($modifications['country'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'country = "'.addslashes($modifications['country']).'" ';
     }

     if(!empty($modifications['zip_code'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'zip_code = "'.intval($modifications['zip_code']).'" ';
     }

     if(!empty($modifications['city'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'city = "'.addslashes($modifications['city']).'" ';
     }

     if(!empty($modifications['mail'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'email = "'.addslashes($modifications['mail']).'" ';
     }

     if(!empty($modifications['phone'])) {
       if(strlen($changes)>17) {
         $changes .=', ';
       }
       $changes .= 'phone = "'.addslashes($modifications['phone']).'" ';
     }

     if(strlen($changes)>17) {
       $changes .= 'WHERE id = :id_user';

       $prep = $this->db->prepare($changes) ;

       $prep->bindParam(':id_user',$user_id);

       $prep->execute();
    }
  }

  public function eventscreation($user_id){
    $prep = $this->db->prepare('SELECT * FROM evenements WHERE id_createur = :user_id ORDER BY date_debut');

    $prep->bindParam(':user_id',$user_id);
    $prep->execute();

    $events = array();

    foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $event) {
      if (!empty($event['date_debut']) && $event['date_debut'] != '0000-00-00 00:00:00') {
        $date_debut_timestamp = strtotime($event['date_debut']);
        $event['date_debut'] = strftime('%d %b %Y', $date_debut_timestamp);
        $event['heure_debut'] = strftime('%H:%M', $date_debut_timestamp);
      } else {
        $event['date_debut'] = null;
        $event['heure_debut'] = null;
      }

      if (!empty($event['date_fin']) && $event['date_fin'] != '0000-00-00 00:00:00') {
        $date_fin_timestamp = strtotime($event['date_fin']);
        $event['date_fin'] = strftime('%d %b %Y', $date_fin_timestamp);
        $event['heure_fin'] = strftime('%H:%M', $date_fin_timestamp);
      } else {
        $event['date_fin'] = null;
        $event['heure_fin'] = null;
      }

      $events[] = $event;
    }

    return $events;
  }

  public function geteventsinscritID($user_id){
    $prep = $this->db->prepare('SELECT id_evenement FROM evenements_participants WHERE id_utilisateur = :user_id');

    $prep->bindParam(':user_id',$user_id);
    $prep->execute();
    return $prep->fetchAll(PDO::FETCH_ASSOC);
  }

  public function geteventsinscritDate($event_id){
    $prep = $this->db->prepare('SELECT date_debut FROM evenements WHERE id = :id_evenement');

    $prep->bindParam(':id_evenement',$event_id);
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }


  public function geteventsDetail($event_id){
    $prep = $this->db->prepare('SELECT * FROM evenements WHERE id = :id_evenement ORDER BY date_debut');

    $prep->bindParam(':id_evenement',$event_id);
    $prep->execute();

    if (!empty($event['date_debut']) && $event['date_debut'] != '0000-00-00 00:00:00') {
      $date_debut_timestamp = strtotime($event['date_debut']);
      $event['date_debut'] = strftime('%d %b %Y', $date_debut_timestamp);
      $event['heure_debut'] = strftime('%H:%M', $date_debut_timestamp);
    } else {
      $event['date_debut'] = null;
      $event['heure_debut'] = null;
    }

    if(!($event = $prep->fetch(PDO::FETCH_ASSOC))) {
      return false;
    }

    if (!empty($event['date_debut']) && $event['date_debut'] != '0000-00-00 00:00:00') {
      $date_debut_timestamp = strtotime($event['date_debut']);
      $event['date_debut'] = strftime('%d %b %Y', $date_debut_timestamp);
      $event['heure_debut'] = strftime('%H:%M', $date_debut_timestamp);
    } else {
      $event['date_debut'] = null;
      $event['heure_debut'] = null;
    }

    if (!empty($event['date_fin']) && $event['date_fin'] != '0000-00-00 00:00:00') {
      $date_fin_timestamp = strtotime($event['date_fin']);
      $event['date_fin'] = strftime('%d %b %Y', $date_fin_timestamp);
      $event['heure_fin'] = strftime('%H:%M', $date_fin_timestamp);
    } else {
      $event['date_fin'] = null;
      $event['heure_fin'] = null;
    }

    return $event;
  }

}
?>
