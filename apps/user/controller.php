<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "User".
 *
 * @package apps/user
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-03-12-2015
 */

class UserController extends Controller {
	/**
	 * @var Instance of Session
	 */
	private $session;

	var $access = array(
		'mesevents'    => 1,
		'updateProfil' => 1,
		'myprofil'     => 1
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
		$data = Request::getAssoc(array('nickname', 'password', 'password_confirm', 'email', 'firstname', 'lastname', 'cgu', 'g-recaptcha-response'));

		if (!in_array(null, $data, true)) {
			$data += Request::getAssoc(array('adress','zip_code','city','country','phone','newsletter'));
			$errors = array();

			// Check Captcha
			require LIBS_DIR.'ReCaptcha'.DS.'autoload.php';

			$recaptcha = new \ReCaptcha\ReCaptcha('6LdmkBMTAAAAAKRjvJVIrAsNbiTUJpFk3IdC7LXt');
			$resp = $recaptcha->verify($data['g-recaptcha-response'], Session::getIP());

			if (!$resp->isSuccess()) {
			  $errors[] = 'Captcha incorrect !';
			}

			// Check nickname availability
			if (($e = $this->model->checkNickname($data['nickname'])) !==	 true) {
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
				$data += Request::getAssoc(array('adress', 'zip_code', 'city', 'country', 'phone'));
				// Configure user
				$user_id = $this->model->createUser($data);

				if ($user_id !== false) {
					return array('data' => $data, 'success' => true);
				} else {
					return array('data' => $data, 'errors' => array('Une erreur inconnue est survenue durant l\'inscription'));
				}
			} else {
				return array('data' => $data, 'errors' => $errors);
			}
		} else if(Request::getMethod() == 'POST') {
			return array('data' => $data, 'errors' => array('Tous les champs requis n\'ont pas été renseignés'));
		}

		return array('data' => $data, 'errors' => array());
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
			$data['region'] =	$maregion['nom'];
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
				$data['region'] =	$maregion['nom'];
			}
			$regiontest = $this->model->getregion();
			foreach($regiontest as $index=>$value){
				if($value['afficher'] == 1){
					$regionsok[$index] = $value;
				}
			}

		$data['nameregions'] = $regionsok;

		}

		$modifications=Request::getAssoc(array('commentaire','birthdate','sex','adress','region','zip_code','city','mail','phone'));
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

		if($isValid == true)	 {
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
}
?>
