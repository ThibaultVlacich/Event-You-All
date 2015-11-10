<?php
/**
 * Main.php
 */

defined('EUA_VERSION') or die('Access denied');

/**
 * Main is the main class that the application launches at start-up.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-09-10-2015
 */
class Main {
	/**
	 * Class constructor
	 */
	public function __construct() {
		// Initializing the route
		$this->route();

		// Executes the application
		$this->exec();
	}

	/**
		 * Initializes the route.
		 * Prevents browser from trying to load a physical file.
		 */
		private function route() {
			Route::init();
			// Checks if the browser tried to load a physical file
			$error = false;
			$query = Route::getQuery();
			$length = strlen($query);
			if (substr($query, $length-3, 1) == '.') {
				$ext = substr($query, $length-2, 2);
				if ($ext == 'js') {
					$error = true;
				}
			} else if (substr($query, $length-4, 1) == '.') {
				$ext = substr($query, $length-3, 3);
				if (in_array($ext, array('css', 'png', 'jpg', 'gif', 'ico', 'svg', 'eot', 'ttf'))) {
					$error = true;
				}
			} else if (substr($query, $length-5, 1) == '.') {
				$ext = substr($query, $length-4, 4);
				if (in_array($ext, array('jpeg', 'woff'))) {
					$error = true;
				}
			}
			if ($error) {
				$route = Route::route();
				if ($route['app'] != 'media') {
					header('HTTP/1.0 404 Not Found');
					//Note::error(404, WLang::get('error_404'), 'die');
				}
			}
		}

  /**
	 * Executes the main application and wrap it into a response for the client.
	 */
  private function exec() {

  }
}

?>
