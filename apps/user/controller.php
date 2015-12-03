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
			$this->setHeader('Location', $redirect);

			return Note::error('user_already_connected', 'No need to access to the login form since you are already connected.');
		}

		// Vars given to trigger login process?
		$data = Request::getAssoc(array('email', 'password'));

    $cookie = true; // cookies accepted by browser?
    $errors = array();

		if (!in_array(null, $data, true)) {
			$data += Request::getAssoc(array('remember', 'time'));

			if (!empty($data['nickname']) && !empty($data['password'])) {
				// User asks to be auto loged in => change the cookie lifetime to WSession::REMEMBER_TIME
				$remember_time = !empty($data['remember']) ? Session::REMEMBER_TIME : abs(intval($data['time'])) * 60;

				// Start login process
				switch ($this->session->createSession($data['nickname'], $data['password'], $remember_time)) {
					case Session::LOGIN_SUCCESS:
						// Update activity
						$this->model->updateLastActivity($_SESSION['userid']);

						if (empty($_COOKIE['wsid'])) {
							array_push($errors, 'Les cookies ne sont pas acceptés par votre navigateur !');
							$cookie = false;
						} else {
							// Redirect
							header('Location: '.$redirect);
						}
						break;
					case Session::LOGIN_MAX_ATTEMPT_REACHED:
						array_push($errors, 'Nombre de tentatives de connexion maximale atteinte ! Ré-essayez plus tard !');
						break;
					case 0:
						array_push($errors, 'Erreur inconnue lors de la connexion');
						break;
				}
			} else {
				array_push($errors, 'Couple Login / Mot de passe incorrect');
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
  }


?>
