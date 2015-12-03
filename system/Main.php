<?php
/**
 * Main.php
 */

defined('EUA_VERSION') or die('Access denied');


require_once SYS_DIR.'Controller.php';
require_once SYS_DIR.'View.php';

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
		// Load the config files
		$this->loadConfigs();

		// Initializing the route
		$this->route();

		// Initializing sessions
		$this->setupSession();

		// Executes the application
		$this->exec();
	}

	/**
 	 * Loads WConfig
 	 */
	private function loadConfigs() {
		Config::load('config', CONFIG_DIR.'config.php', 'php');
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
			$route = Route::getRoute();
			if ($route['app'] != 'media') {
				header('HTTP/1.0 404 Not Found');
				//Note::error(404, WLang::get('error_404'), 'die');
			}
		}
	}


		/**
		 * Initializes session and check the flood condition
		 */
		private function setupSession() {
			// Instanciates it
			$session = System::getSession();

			// Anti-flood checking
			if (!$session->check_flood()) {
				$_POST = array();
			}
		}

  /**
	 * Executes the main application and wrap it into a response for the client.
	 */
  private function exec() {
		$route = Route::getRoute();

		$app = !empty($route['app']) ? $route['app'] : Config::get('config.defaultapp');
		$app_dir = APPS_DIR.$app.DS;

		if (is_dir($app_dir) && file_exists($app_dir.'controller.php')) {
			include_once $app_dir.'controller.php';

			$app_name_clear = str_replace(' ', '', ucwords(preg_replace('#[^a-zA-Z]+#', ' ', $app)));
			$app_class = $app_name_clear.'Controller';

			if (class_exists($app_class) && get_parent_class($app_class) == 'Controller') {
				$controller = new $app_class();

				// Instantiate Model if exists
				if (file_exists($app_dir.'model.php')) {
					include_once $app_dir.'model.php';

					$model_class = str_replace('Controller', 'Model', $app_class);

					if (class_exists($model_class)) {
						$controller->setModel(new $model_class());
					}
				}

				// Instantiate View if exists
				if (file_exists($app_dir.'view.php')) {
					include_once $app_dir.'view.php';

					$view_class = str_replace('Controller', 'View', $app_class);

					if (class_exists($view_class) && get_parent_class($view_class) == 'View') {
						$controller->setView(new $view_class());
					}
				}

				// Render the app
				$app_rendered = $controller->render();

				// Now render it in the global template
				include_once TEMPLATES_DIR.'template.php';
			}
		}
  }
}

?>
