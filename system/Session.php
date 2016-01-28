<?php
/**
 * Session.php
 */
defined('EUA_VERSION') or die('Access denied');

/**
 * Session manages all session variables.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-03-12-2015
 */
class Session {
  /*
   * Default session life when the user asks to remember his account
   * @type int
   */
  const REMEMBER_TIME = 2419200; // 1 month

  /**
   * Time before the session expires (seconds)
   */
  const TOKEN_EXPIRATION = 120;

  /**
   * States
   */
  const USER_BANNED   = -1;
  const LOGIN_SUCCESS = 1;
  const NOT_VALIDATED = 2;

  /**
   * Session setup
   */
  public function __construct() {
    // No sid in HTML links
    ini_set('session.use_trans_sid', '0');
    session_name('wsid');
    session_set_cookie_params(self::REMEMBER_TIME, Route::getDir());

    // Start sessions
    session_start();

    if ($this->isConnected()) {
      // Token expiration checking
      if (empty($_SESSION['token_expiration']) || time() >= $_SESSION['token_expiration']) {
        $this->reloadSession($_SESSION['userid']);
      }
    }
    // Attempt to reload the user session based on its cookies
    else if (!empty($_COOKIE['userid'])) {
      // Hash => unique connection
      $this->reloadSession(intval($_COOKIE['userid']));
    }
  }

  /**
   * Is the user logged in?
   *
   * @return boolean true if the user is logged in, false otherwise
   */
  public static function isConnected() {
    return isset($_SESSION['userid']);
  }

  /**
   * Creates a session for the user
   *
   * @param string $nickname nickname
   * @param string $password password
   * @param string $remember true if auto-log in of the user enabled for the next time
   * @return int State of the request (LOGIN_SUCCESS | 0 = error)
   */
  public function createSession($nickname, $password, $remember) {
    // Treatment
    $nickname = trim($nickname);

    // Email to lower case
    if (strpos($nickname, '@') !== false) {
      $nickname = strtolower($nickname);
    }
    $password_hash = sha1($password);

    // Search a matching couple (nickname, password_hash) in DB
    include_once APPS_DIR.'user'.DS.'model.php';

    $userModel = new UserModel();
    $data = $userModel->matchUser($nickname, $password_hash);

    // User found
    if (!empty($data)) {
      if($data['access'] == -1) {
        return self::USER_BANNED;
      }

      if($data['access'] == 0) {
        return self::NOT_VALIDATED;
      }

      $this->setupSession($data['id'], $data);

      // Cookie setup
      if ($remember > 0) {
        $lifetime = time() + $remember;

        // Cookie setup
        setcookie('userid', $_SESSION['userid'], $lifetime, Route::getDir());
        setcookie('hash', $this->generate_hash($data['nickname'], $data['password']), $lifetime, Route::getDir());
      }

      return self::LOGIN_SUCCESS;
    } else {
      return 0;
    }
  }

  /**
   * Setup session variables for the user
   *
   * @param string $userid current user id
   * @param array $data data to store into $_SESSION
   */
  public function setupSession($userid, $data) {
    $_SESSION['userid']    = $userid;
    $_SESSION['nickname']  = $data['nickname'];
    $_SESSION['email']     = $data['email'];
    $_SESSION['firstname'] = $data['firstname'];
    $_SESSION['lastname']  = $data['lastname'];
    $_SESSION['access']    = $data['access'];

    // Next checking time
    $_SESSION['token_expiration'] = time() + self::TOKEN_EXPIRATION;
  }

  /**
   * Disconnects the user
   */
  public function closeSession() {
    // Delete vars
    unset(
      $_SESSION['userid'],
      $_SESSION['nickname'],
      $_SESSION['email'],
      $_SESSION['firstname'],
      $_SESSION['lastname'],
      $_SESSION['access_string'],
      $_SESSION['access'],
      $_SESSION['token_expiration']
    );

    // Reset cookies
    setcookie('userid', '', time()-3600, Route::getDir());
    setcookie('hash', '', time()-3600, Route::getDir());
  }

  /**
   * Clean variables used to define a user loaded
   */
  public function destroy() {
    $this->closeSession();

    $_SESSION = array();

    session_destroy();

    // Reset cookies
    setcookie(session_name(), '', time()-3600, Route::getDir());
  }

  /**
   * Reloads a user based on cookies
   *
   * @param string $userid        current user id
   * @param string $cookie_hash   cookie hash for security checking
   * @return boolean true if successfully reloaded, false otherwise
   */
  public function reloadSession($userid) {
    if (!empty($_COOKIE['hash'])) {
      include_once APPS_DIR.'user'.DS.'model.php';

      $userModel = new UserModel();
      $data = $userModel->getUser($userid);

      if (!empty($data)) {
        // Check hash
        if ($_COOKIE['hash'] == $this->generate_hash($data['nickname'], $data['password'])) {
          $this->setupSession($userid, $data);

          return true;
        }
      }
    }

    $this->closeSession();

    return false;
  }

  /**
   * Generates a user-and-computer specific hash that will be stored in a cookie
   *
   * @param string $nick nickname
   * @param string $pass password
   * @param boolean $environment optional value: true if we want to use environment specific values to generate the hash
   * @return string the generated hash
   */
  public function generate_hash($nick, $pass, $environment = true) {
    $string = $nick.$pass;

    // Link the hash to the user's environment
    if ($environment) {
      $string .= $_SERVER['HTTP_USER_AGENT'].$_SERVER['HTTP_ACCEPT_LANGUAGE']."*";
    }

    return sha1($string);
  }

  /**
   * Get the IP of the client.
   *
   * @return string Either an ipv4 or an ipv6 address
   */
  public static function getIP() {
    if ($ip = getenv('HTTP_CLIENT_IP')) {}
    else if ($ip = getenv('HTTP_X_FORWARDED_FOR')) {}
    else if ($ip = getenv('HTTP_X_FORWARDED')) {}
    else if ($ip = getenv('HTTP_FORWARDED_FOR')) {}
    else if ($ip = getenv('HTTP_FORWARDED')) {}
    else if ($ip = getenv('HTTP_REMOTE_ADDR')) {}
    else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
  }
}
?>
