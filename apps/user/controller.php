<?php

class UserController extends Controller {
  /*
	 * @var Instance of WSession
	 */
	private $session;

  var $default_module = 'lol';

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
				// User asks to be auto loged in => change the cookie lifetime to WSession::REMEMBER_TIME
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
					case Session::LOGIN_MAX_ATTEMPT_REACHED:
						array_push($errors, 'Nombre de tentatives de connexion maximale atteinte ! Ré-essayez plus tard !');
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
		$data = Request::getAssoc(array('nickname', 'password', 'password_confirm', 'email', 'firstname', 'lastname', 'cgu'));

		if (!in_array(null, $data, true)) {
			$errors = array();

			// Check nickname availability
			if (($e = $this->model->checkNickname($data['nickname'])) !== true) {
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

			// Default access (0: simple user)
			$data['access'] = 0;

			if (empty($errors)) {
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
}

?>
