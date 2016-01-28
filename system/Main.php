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
 * @version 1.1.0-09-10-2015
 */
class Main {
  /**
   * @var is404 If set to true, should display a 404 error
   */
  private $is404 = false;

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
    * Loads Configs
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

    // Checks if the browser tried to load a physical file who doesn't exists
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

    $this->is404 = $error;
  }


  /**
   * Initializes session
   */
  private function setupSession() {
    // Instanciates it
    $session = System::getSession();
  }

    /**
   * Executes the main application and wrap it into a response for the client.
   */
  private function exec() {
    $route = Route::getRoute();

    $admin = $route['admin'] == 1;

    $app = !empty($route['app']) ? $route['app'] : ($admin ? Config::get('config.defaultadminapp') : Config::get('config.defaultapp'));

    // Calculates app's directory and class name
    if ($admin) {
      $app_dir        = APPS_DIR.$app.DS.'admin'.DS;
      $app_name_clear = str_replace(' ', '', ucwords(preg_replace('#[^a-zA-Z]+#', ' ', $app)));
      $app_class      = $app_name_clear.'AdminController';
    } else {
      $app_dir        = APPS_DIR.$app.DS;
      $app_name_clear = str_replace(' ', '', ucwords(preg_replace('#[^a-zA-Z]+#', ' ', $app)));
      $app_class      = $app_name_clear.'Controller';
    }

    if (is_dir($app_dir) && file_exists($app_dir.'controller.php') && !$this->is404) {
      include_once $app_dir.'controller.php';

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
      }
    } else {
      // Set header to a 404 code
      header('HTTP/1.0 404 Not Found');

      // Load the 404 app
      include_once APPS_DIR.'404'.DS.'controller.php';
      include_once APPS_DIR.'404'.DS.'view.php';

      $controller = new NotFoundController();
      $view = new NotFoundView();

      $controller->setView($view);
    }

    // Render the app
    $app_rendered = $controller->render();

    // Now render it in the global template
    include_once TEMPLATES_DIR.'template'.($admin ? '_admin' : '').'.php';
  }
}

?>
