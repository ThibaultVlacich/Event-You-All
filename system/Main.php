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
		// Do things

		// Executes the application
		$this->exec();
	}

  /**
	 * Executes the main application and wrap it into a response for the client.
	 */
  private function exec() {

  }
}

?>
