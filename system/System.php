<?php
/**
 * System.php
 */

defined('EUA_VERSION') or die('Access denied');

/**
 * System keeps the session and database instances as singletons.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-26-11-2015
 */
class System {
  /**
   * @var Session Session object
   */
  private static $sessionInstance;

  /**
   * @var Database Database object
   */
  private static $dbInstance;

  /**
   * @var Stores the application list
   * @static
   */
  private static $apps_list = array();

  /**
   * Returns current session or creates it if it doesn't exist yet
   * @return Session returns current session
   */
  public static function getSession() {
    if (!is_object(self::$sessionInstance)) {
      require_once SYS_DIR.'Session.php';
      self::$sessionInstance = new Session();
    }

    return self::$sessionInstance;
  }

  /**
   * Returns current database manager or creates it if it doesn't exist yet
   * @return Database returns current database manager
   */
  public static function getDB() {
    if (!is_object(self::$dbInstance)) {
      Config::load('database', SYS_DIR.'config'.DS.'database.php', 'php');

      $server   = Config::get('database.server');
      $dbname   = Config::get('database.dbname');
      $port     = Config::get('database.port');
      $dsn      = 'mysql:dbname='.$dbname.';host='.$server;

      if (!empty($port)) {
        $dsn .= ';port='.$port;
      }

      $user     = Config::get('database.user');
      $password = Config::get('database.pw');

      if (empty($server) || empty($dbname) || empty($user)) {
        die('Information is missing to connect to the database: please, check the server, or the database name or the user name in "system/config/database.php".');
      }

      self::$dbInstance = new PDO($dsn, $user, $password);
      self::$dbInstance->query("SET NAMES 'utf8'");
      self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    return self::$dbInstance;
  }

  /**
   * Returns a list of applications that contains a main.php file in their front directory
   *
   * @return array Array of string containing app's name
   */
  public static function getAppsList() {
    if (empty(self::$apps_list)) {
      $apps = glob(APPS_DIR.'*', GLOB_ONLYDIR);

      foreach ($apps as $appDir) {
        if ($appDir != '.' && $appDir != '..') {
          // Check front
          if (file_exists($appDir.DS.'controller.php')) {
            self::$apps_list[] = basename($appDir);
          }

          // Check admin
          if (file_exists($appDir.DS.'admin'.DS.'controller.php')) {
            self::$apps_list[] = 'admin/'.basename($appDir);
          }
        }
      }
    }

    return self::$apps_list;
  }
}

?>
