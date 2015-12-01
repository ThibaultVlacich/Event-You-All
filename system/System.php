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
 * @version 0.1.0-dev-26-11-2015
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
				Note::error('system_database_init', Lang::get('error_database_bad_credentials'), 'die');
			}

			self::$dbInstance = new Database($dsn, $user, $password);
			self::$dbInstance->query("SET NAMES 'utf8'");
			self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		}

		return self::$dbInstance;
	}
}

?>
