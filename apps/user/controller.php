<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "User".
 *
 * @package apps/user
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-03-12-2015
 */

class UserController extends Controller {
  /**
   * @var Instance of Session
   */
  private $session;

  var $access = array(
    'mesevents'      => 1,
    'updateProfil'   => 1,
    'myprofil'       => 1,
    'mestopics'      => 1,
    'mesevents'      => 1,
    'updatepassword' => 1
  );

  /**
   * UserController's constructor to initialize $session.
   */
  public function __construct() {
    $this->session = System::getSession();
  }

  /**
   * The Login action allows a user to connect to his account.
   *
   * @param array $params Redirect is expected in this array
   * @return array Model containing the redirect link
   */
  protected function login($params) {
    // Find redirect URL
    $referer = Route::getReferer();
    $redirect_request = Request::get('redirect');

    if (empty($params[0])) {
      $route = Route::getRoute();

      if (!empty($redirect_request)) {
        $redirect = $redirect_request;
      } else if ($route['app'] != 'user') { // Login form loaded from an external application
        $redirect = Route::getDir().Route::getQuery();
      } else if (strpos($referer, 'user') === false) {
        $redirect = $referer;
      } else {
        $redirect = Route::getDir();
      }
    } else {
      $redirect = $params[0];
    }

    if ($this->session->isConnected()) {
      return array('errors' => array('Vous êtes déjà connecté !'));
    }

    // Vars given to trigger login process?
    $data = Request::getAssoc(array('email', 'password'));

    $cookie = true; // cookies accepted by browser?
    $errors = array();

    if (!in_array(null, $data, true)) {
      $data += Request::getAssoc(array('remember', 'time'));

      if (!empty($data['email']) && !empty($data['password'])) {
        // User asks to be auto loged in => change the cookie lifetime to Session::REMEMBER_TIME
        $remember_time = !empty($data['remember']) ? Session::REMEMBER_TIME : abs(intval($data['time'])) * 60;

        // Start login process
        switch ($this->session->createSession($data['email'], $data['password'], $remember_time)) {
          case Session::LOGIN_SUCCESS:
            // Update activity
            if (empty($_COOKIE['wsid'])) {
              array_push($errors, 'Les cookies ne sont pas acceptés par votre navigateur !');
              $cookie = false;
            } else {
              // Redirect
              return array('success' => true);
            }
            break;
          case Session::USER_BANNED:
            array_push($errors, 'Vous avez été banni du site ! <a href="'.Config::get('config.base').'/contact">Contactez l\'administrateur</a>.');
            break;
          case Session::NOT_VALIDATED:
            array_push($errors, 'Votre compte n\'a pas encore été activé !');
            break;
          case 0:
            array_push($errors, 'Couple Login / Mot de passe incorrect.');
            break;
        }
      } else {
        array_push($errors, 'Les champs requis n\'ont pas été rensignés.');
      }
    }

    return array(
      'redirect' => $redirect,
      'errors'   => $errors
    );
  }

  /**
   * Logout action handler.
   *
   * @return array Success note
   */
  protected function logout() {
    if ($this->session->isConnected()) {
      // Destroy the session of the user
      $this->session->closeSession();
    }

    header('Location: '.Route::getDir());
  }

  /**
   * The Register action allows a user to register a new account.
   *
   * @return array Data given
   */
  protected function register() {
    $regions = $this->model->getregion();

    $data = Request::getAssoc(array('nickname', 'password', 'password_confirm', 'email', 'firstname', 'lastname', 'cgu', 'g-recaptcha-response'));

    if (!in_array(null, $data, true)) {
      $data += Request::getAssoc(array('adress','zip_code','city','region','phone','newsletter'));
      $errors = array();

      // Check Captcha
      require LIBS_DIR.'ReCaptcha'.DS.'autoload.php';

      $recaptcha = new \ReCaptcha\ReCaptcha('6LdmkBMTAAAAAKRjvJVIrAsNbiTUJpFk3IdC7LXt');
      $resp = $recaptcha->verify($data['g-recaptcha-response'], Session::getIP());

      if (!$resp->isSuccess()) {
        $errors[] = 'Captcha incorrect !';
      }

      // Check nickname availability
      if (($e = $this->model->checkNickname($data['nickname'])) !==   true) {
        $errors[] = $e;
      }

      // Matching passwords
      if (!empty($data['password'])) {
        if ($data['password'] === $data['password_confirm']) {
          $data['password'] = sha1($data['password']);
        } else {
          $errors[] = 'Les mots de passe saisis ne concordent pas.';
        }
      } else {
        $errors[] = 'Aucun mot de passe n\'a été saisi.';
      }

      // Email availability
      if (($e = $this->model->checkEmail($data['email'])) !== true) {
        $errors[] = $e;
      }

      if (empty($errors)) {
        // Set a confirm code
        $data['confirm'] = uniqid();

        // Configure user
        $user_id = $this->model->createUser($data);

        if ($user_id !== false) {
          // Send a validation email
          $headers  = "From: " . strip_tags(Config::get('config.email')) . "\r\n";
          $headers .= "Reply-To: ". strip_tags(Config::get('config.email')) . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          $message  = 'Bonjour <strong>'.$data['nickname'].'</strong>,<br><br>' . "\r\n";
          $message .= 'Votre inscription sur Event-You-All a bien été prise en compte !<br>Cependant, vous devez toujours confirmer votre email avant de pouvoir vous connecter !<br><br>' . "\r\n";
          $message .= 'Pour pouvoir valider votre email, veuillez cliquer sur <a href="'.Config::get('config.base').'/user/activate/'.$data['confirm'].'">ce lien</a><br><br>' . "\r\n";
          $message .= 'Merci et à bientôt sur Event-You-All !';

          mail($data['email'], 'Event-You-All : Validez votre inscription', $message, $headers);

          return array('data' => $data, 'success' => true);
        } else {
          return array('data' => $data, 'errors' => array('Une erreur inconnue est survenue durant l\'inscription'));
        }
      } else {
        return array('data' => $data, 'errors' => $errors);
      }
    } else if(Request::getMethod() == 'POST') {
      return array('data' => $data, 'errors' => array('Tous les champs requis n\'ont pas été renseignés'), 'regions' => $regions);
    }

    return array('data' => $data, 'errors' => array(), 'regions' => $regions);
  }

  /**
   * The Activate action allows the user to validate its account after registering.
   *
   * @param array $params
   * @return void
   */
  protected function activate(array $params) {
    // Retrieve the confirm code
    $confirm_code = array_shift($params);

    if (empty($confirm_code)) {
      $this->setHeader('Location', Config::get('config.base'));
      return;
    }

    $data = $this->model->findUserWithConfirmCode($confirm_code);

    if (empty($data)) { // No confirm code found
      return array('errors' => array('Aucun membre n\'a été trouvé avec ce code de confirmation'));
    }

    $this->model->activateUser($data['id']);

    return array('success' => true);
  }

  // Function which enables us to get the forgiven password in the database
  public function passwordlost() {
    $data = Request::getAssoc(array('email'));

    if(!in_array(null, $data, true)) {
      // Check if the asked user exists in database
      $user = $this->model->checkIfMailIsInDatabase($data['email']);

      if ($user) { // Yes, he exists
        // Generate a new password
        $newpassword = $this->model->generateNewPasswordForUser($user['id']);

        // Send him the new password
        $message = 'Bonjour, voici votre nouveau mot de passe sur Event-You-All : '.$newpassword."\r\n".'Nous vous conseillons de le changer le plus rapidement possible dans la section Modifier mon Mot de Passe. A bientôt sur Event-You-All !';

        mail($user['email'], 'Event-You-All : Votre nouveau mot de passe', $message, 'From: '.Config::get('config.email'));

        return array('success' => true);
      } else {
        return array('success' => false, 'errors' => array('L\'utilisateur demandé n\'existe pas !'));
      }
    }
  }

  public function myprofil(array $params) {
    //Takes user id
    $session = System::getSession();
    if ($session->isConnected()) {
      $user_id = $_SESSION['userid'];
    }
    $data = $this->model->getUser($user_id);

    if(empty($data['photoprofil'])){
      $data['photoprofil'] = Config::get('config.base').'/apps/user/images/photoinconnu.png';
    }

    if(empty($data['id_region'])){
      $data['region'] = 'Non renseigné';
    }
    else{
      $maregion = $this->model->getregionwithid($data['id_region']);
      $data['region'] =  $maregion['nom'];
    }

    if(empty($data['commentaire'])){
      $data['commentaire'] = "Vous n'avez encore laissé aucun commentaire sur vous ! Pour entrer maintenant un commentaire, cliquez sur modifier mon profil.";
    }

    if(empty($data['birthdate'])){
      $data['birthdate'] = 'Non renseigné';
    }

    if(empty($data['sex'])){
      $data['sex'] = 'Non renseigné';
    }

    if(empty($data['zip_code'])){
      $data['zip_code'] = 'Non renseigné';
    }

    if(empty($data['city'])){
      $data['city'] = 'Non renseigné';
    }

    if(empty($data['phone'])){
      $data['phone'] = 'Non renseigné';
    }

    if(empty($data['adress'])){
      $data['adress'] = 'Non renseigné';
    }

    return $data;
  }

  public function updateProfil(array $params) {

    $session = System::getSession();

    if ($session->isConnected()){

      $user_id = $_SESSION['userid'];

      $data = $this->model->getUser($user_id);
      if(empty($data['photoprofil'])){
        $data['photoprofil'] = Config::get('config.base').'/apps/user/images/photoinconnu.png';
      }

      if(empty($data['birthdate'])){
        $data['birthdate'] = 'Non renseigné';
      }

      if(empty($data['sex'])){
        $data['sex'] = 'Non renseigné';
      }

      if(empty($data['zip_code'])){
        $data['zip_code'] = 'Non renseigné';
      }

      if(empty($data['city'])){
        $data['city'] = 'Non renseigné';
      }

      if(empty($data['phone'])){
        $data['phone'] = 'Non renseigné';
      }

      if(empty($data['adress'])){
        $data['adress'] = 'Non renseigné';
      }

      if(empty($data['id_region'])){
        $data['region'] = 'Non renseigné';
      }
      else{
        $maregion = $this->model->getregionwithid($data['id_region']);
        $data['region'] =  $maregion['nom'];
      }
      $regionsok =array();
      $regiontest = $this->model->getregion();
      foreach($regiontest as $index=>$value){
        if($value['afficher'] == 1){
          $regionsok[$index] = $value;
        }
      }

    $data['nameregions'] = $regionsok;

    }

    $modifications=Request::getAssoc(array('date_de_j','date_de_m','date_de_a','commentaire','sex','adress','region','zip_code','city','mail','phone'));
    //checks that something has been modified
    $photoprofil = Request::get('photoprofil', null, 'FILES');

    $isValid = false;
    foreach ($modifications as $value) {
      if(!empty($value)) {
        $isValid = true;
      }
    }
    if(!empty($photoprofil)){
      $isValid = true;
    }
    if(isset($modifications['date_de_j']) && empty($modifications['date_de_j']) && isset($modifications['date_de_m']) && !empty($modifications['date_de_m']) && isset($modifications['date_de_a']) && !empty($modifications['date_de_a'])){
      $isValid = false;
    }
    if(isset($modifications['date_de_j']) && !empty($modifications['date_de_j']) && isset($modifications['date_de_m']) && empty($modifications['date_de_m']) && isset($modifications['date_de_a']) && !empty($modifications['date_de_a'])){
      $isValid = false;
    }
    if(isset($modifications['date_de_j']) && !empty($modifications['date_de_j']) && isset($modifications['date_de_m']) && !empty($modifications['date_de_m']) && isset($modifications['date_de_a']) && empty($modifications['date_de_a'])){
      $isValid = false;
    }
    if(isset($modifications['date_de_j']) && !empty($modifications['date_de_j']) && isset($modifications['date_de_m']) && empty($modifications['date_de_m']) && isset($modifications['date_de_a']) && empty($modifications['date_de_a'])){
      $isValid = false;
    }
    if(isset($modifications['date_de_j']) && empty($modifications['date_de_j']) && isset($modifications['date_de_m']) && !empty($modifications['date_de_m']) && isset($modifications['date_de_a']) && empty($modifications['date_de_a'])){
      $isValid = false;
    }
    if(isset($modifications['date_de_j']) && empty($modifications['date_de_j']) && isset($modifications['date_de_m']) && empty($modifications['date_de_m']) && isset($modifications['date_de_a']) && !empty($modifications['date_de_a'])){
      $isValid = false;
    }

    if(isset($modifications['date_de_j']) && !empty($modifications['date_de_j']) && isset($modifications['date_de_m']) && !empty($modifications['date_de_m']) && isset($modifications['date_de_a']) && !empty($modifications['date_de_a'])){
      $modifications['birthdate'] = $modifications['date_de_a'].'-'.$modifications['date_de_m'].'-'.$modifications['date_de_j'];
      $isValid = true;
    }

    if($isValid == true)   {
      if(!empty($photoprofil)){
        $errors = [];
        $maxwidth = 100000;
        $minwidth = 0;
        $maxheight = 100000;
        $minheight = 0;
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
        $extension_upload = strtolower(  substr(  strrchr($photoprofil['name'], '.')  ,1)  );
        if (in_array($extension_upload,$extensions_valides) ){
          $sizeimage=getimagesize($photoprofil['tmp_name']);
          if ($sizeimage[0] > $minwidth and $sizeimage[1] > $minheight){
            $new_file_name = $photoprofil['name'];
            move_uploaded_file($photoprofil['tmp_name'], UPLOAD_DIR.'user'.DS.'photoprofil'.DS.$new_file_name);
            $modifications['photoprofil'] = Config::get('config.base').'/upload/user/photoprofil/'.$new_file_name;
          }
           else {
            $errors += array('Problème de dimension pour le poster : trop petit en hauteur et/ou en largeur');
          }
        }
        else {
           $errors += array('Problème d\'extension pour le poster : votre fichier n\'est pas du type png, jpeg, jpg ou gif');
        }
      }


      $modifsresults = $this->model->changeprofil($modifications, $user_id);//function defined in model
      return array('data' => $data, 'success' => true, 'errors' => $errors);
  }
    elseif($isValid == false ){
      return array('data' => $data, 'success' => 'rien'); }

    else{
          return array('data' => $data, 'success' => false); }

  }

  public function mesevents(){

    $session = System::getSession();

    if (!$session->isConnected()){
      return;
    }

    $user_id = $_SESSION['userid'];

    $data['eventscreation'] = $this->model->eventscreation($user_id);
    foreach($data['eventscreation'] as $index=> $value){
      $data['eventscreation'][$index]['type'] = $this->model->gettypewithid($data['eventscreation'][$index]['id_type']);
      $data['eventscreation'][$index]['theme'] = $this->model->getthemewithid($data['eventscreation'][$index]['id_theme']);

    }


    $dateactuelle = time();

    $eventsinscrit = $this->model->geteventsinscritID($user_id);
    if(!empty($eventsinscrit)){
      foreach($eventsinscrit as $index=>$value){
        $dateevent = $this->model->geteventsinscritDate($value['id_evenement']);
        if(strtotime($dateevent['date_debut']) > $dateactuelle){
          $data['eventsinscrit'][$index] = $this->model->geteventsDetail($value['id_evenement']);
          $data['existenceinscription'] = true;
          $data['eventsinscrit'][$index]['type'] = $this->model->gettypewithid($data['eventsinscrit'][$index]['id_type']);
          $data['eventsinscrit'][$index]['theme'] = $this->model->getthemewithid($data['eventsinscrit'][$index]['id_theme']);
        }
        else{
          $data['eventspasse'][$index] = $this->model->geteventsDetail($value['id_evenement']);
          $data['existenceinscriptionpasse'] = true;
          $data['eventspasse'][$index]['type'] = $this->model->gettypewithid($data['eventspasse'][$index]['id_type']);
          $data['eventspasse'][$index]['theme'] = $this->model->getthemewithid($data['eventspasse'][$index]['id_theme']);
        }
      }
    }

    if(empty($data['existenceinscription'])){
      $data['existenceinscription'] = false;
    }
    if(empty($data['existenceinscriptionpasse'])){
      $data['existenceinscriptionpasse'] = false;
    }
    return $data;
  }

  public function mestopics(){
    $session = System::getSession();

    if (!$session->isConnected()){
      return;
    }

    $user_id = $_SESSION['userid'];

    $data['topicscreation'] = $this->model->topicscreation($user_id);

    return $data;
  }

  public function updatepassword(array $params){
    $session = System::getSession();
    if ($session->isConnected()) {
      $user_id = $_SESSION['userid'];
    }

    $oldpassword = $this->model->getoldpasswordcheck($user_id);
    $modifications = Request::getAssoc(array('oldpassword','newpassword','newpasswordcheck'));
    if(empty($modifications['oldpassword']) && empty($modifications['newpassword']) && empty($modifications['newpasswordcheck'])){
      $nothingyet = true;
    }
    else{
      $nothingyet = false;
    }
    $error = '';

    if($oldpassword['password'] == sha1($modifications['oldpassword'])){
      if($modifications['newpassword'] == $modifications['newpasswordcheck']){
        $a = $this->model->modifpassword($user_id, sha1($modifications['newpassword']));
      }
      else{
        $error .= 'Les deux mots de passe sont différents';
      }
    }
    else{
      $error .= 'Mot de Passe erroné !';
    }
    if(empty($error)){
      $data = array('success'=>true, 'error'=>$error);
    }
    elseif ($nothingyet===true) {
      $data = array('success'=>'pasencore');
    }
    else{
      $data = array('success'=>false, 'error'=>$error);
    }
    return $data;
  }

  function profile(array $params) {
    if(!isset($params[0])) {
      return false;
    }

    $user_id = intval($params[0]);

    if(!($user = $this->model->getUser($user_id))) {
      return false;
    }

    // Check if user has an avatar
    if(empty($user['photoprofil'])) {
      $user['photoprofil'] = Config::get('config.base').'/apps/user/images/photoinconnu.png';
    }

    // Format register date of the user
    $register_date_timestamp = strtotime($user['register_date']);
    $user['register_date'] = strftime('%a %d %b %Y', $register_date_timestamp);

    // Get the age of the user
    if(!empty($user['birthdate']) && $user['birthdate'] != '0000-00-00') {
      $birthdate = new DateTime($user['birthdate']);
      $user['age'] = $birthdate->diff(new DateTime('now'))->y;
    }

    // Get the region of the user
    if(!empty($user['id_region'])) {
      $user['region'] = $this->model->getregionwithid($user['id_region']);
    }

    // Get events of the user (created/participated)
    $eventscreated = $this->model->eventscreation($user_id);
    foreach($eventscreated as $index => $value){
      $eventscreated[$index]['type'] = $this->model->gettypewithid($eventscreated[$index]['id_type']);
      $eventscreated[$index]['theme'] = $this->model->getthemewithid($eventscreated[$index]['id_theme']);
    }

    $dateactuelle = time();

    $eventsinscrit = $this->model->geteventsinscritID($user_id);

    $eventsfutur = array();
    $eventspasse = array();

    if(!empty($eventsinscrit)) {
      foreach($eventsinscrit as $index => $value){
        $dateevent = $this->model->geteventsinscritDate($value['id_evenement']);
        if(strtotime($dateevent['date_debut']) > $dateactuelle){
          $eventsfutur[$index] = $this->model->geteventsDetail($value['id_evenement']);
          $eventsfutur[$index]['type'] = $this->model->gettypewithid($eventsfutur[$index]['id_type']);
          $eventsfutur[$index]['theme'] = $this->model->getthemewithid($eventsfutur[$index]['id_theme']);
        } else {
          $eventspasse[$index] = $this->model->geteventsDetail($value['id_evenement']);
          $eventspasse[$index]['type'] = $this->model->gettypewithid($eventspasse[$index]['id_type']);
          $eventspasse[$index]['theme'] = $this->model->getthemewithid($eventspasse[$index]['id_theme']);
        }
      }
    }

    return array(
      'user'          => $user,
      'eventscreated' => $eventscreated,
      'eventsfutur'   => $eventsfutur,
      'eventspasse'   => $eventspasse
    );
  }

  public function contact(array $params) {
    if(isset($params[0])) {
      $id_user = intval($params[0]);

      $user = $this->model->getUser($id_user);
    } else {
      return array('success' => false);
    }

    $message = Request::get('message');
    $sujet = Request::get('subject');

    $session = System::getSession();

    if ($session->isConnected()) {
      $expediteur_id = $_SESSION['userid'];
    } else {
      return array('data' => $data, 'not_register' => 'Vous n\'êtes pas connecté');
    }

    $expediteur = $this->model->getUser($expediteur_id);

    $headers  = "From: " . strip_tags($expediteur['email']) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($expediteur['email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if(!empty($message) && !empty($sujet)){
      $html_message  = 'Bonjour <strong>'.$user['nickname'].'</strong>,<br><br>' . "\r\n";
      $html_message .= 'Vous avez reçu un message de la part de <strong>'.$expediteur['nickname'].'</strong> sur <strong>Event-You-All</strong>.<br><br>' . "\r\n";
      $html_message .= '<blockquote>'.$message.'</blockquote>';

      mail($user['email'], $sujet, $html_message, $headers);

      return array('user' => $user, 'success' => true);
    } else {
      return array('user' => $user, 'success' => '');
    }
  }
}
?>
