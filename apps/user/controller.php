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
						//$this->model->updateLastActivity($_SESSION['userid']);

						if (empty($_COOKIE['wsid'])) {
							array_push($errors, 'Les cookies ne sont pas acceptés par votre navigateur !');
							$cookie = false;
						} else {
							// Redirect
							return array('success' => true);
						}
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
				$message = 'Bonjour, voici votre nouveau mot de passe sur Event-You-All : '.$newpassword.'. Nous vous conseillons de le changer le plus rapidement possible dans la section Modifier mon profil. A bientôt sur Event-You-All !';

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
		if($data['profilprive'] == 1){
			$data['profilprive'] = 'Profil Privé';
		}
		if($data['profilprive'] == 0){
			$data['profilprive'] = 'Profil Public';
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

			if($data['profilprive'] == 1){
				$data['profilprive'] = 'Profil Privé';
			}
			if($data['profilprive'] == 0){
				$data['profilprive'] = 'Profil Public';
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
		}

		$modifications=Request::getAssoc(array('photoprofil','commentaire','profilprive','birthdate','sex','adress','country','zip_code','city','mail','phone'));

		//checks that something has been modified
		$isValid = false;
		foreach ($modifications as $value) {
			if(!empty($value)) {
				$isValid = true;
			}
		}

		if($isValid == true)	 {
			$modifsresults = $this->model->changeprofil($modifications, $user_id);//function defined in model
			return array('data' => $data, 'success' => true);
		}

		elseif($isValid == false ){
			return array('data' => $data, 'success' => 'rien'); }

		else{
					return array('data' => $data, 'success' => false); }

	}

	public function mesevents(){

		$session = System::getSession();

		if ($session->isConnected()){

			$user_id = $_SESSION['userid'];
		}

		$data['eventscreation'] = $this->model->eventscreation($user_id);
	}
}
?>
