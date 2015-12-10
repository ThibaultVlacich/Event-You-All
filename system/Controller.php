<?php
/**
 * Controller.php
 */
defined('EUA_VERSION') or die('Access denied');
/**
 * Controller is the base class that will be inherited by all the applications.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-02-12-2015
 */
abstract class Controller {
	/**
	 * @var mixed Model class to retrieve application's data from the database
	 */
	protected $model;

	/**
	 * @var mixed View class to retrieve application's data from the database
	 */
	protected $view;

	/**
	 * @var array Access levels of each module of the app
	 *
	 * By default, everybody has access to all modules of the app
	 */
	protected $access = array();

	/**
	 * Execute the asked method of the Controller
	 *
	 *	@param $module string Name of the module to execute
	 * @param $params array List of the paramameters
	 *
	 * @return array
	 */
	public final function execute($module = '', $params = array()) {
		 if(method_exists($this, $module)) {
			 return $this->$module($params);
		 }
	 }

	/**
	 * Render the template
	 *
	 * @return string content of the rendered app
	 * @return false if user has no access
	 */
	public final function render() {
		$route = Route::getRoute();
		$params = $route['params'];

		// Extract the name of the module from the parameters
		$module = isset($params[0]) ? $params[0] : $this->default_module;

		// Check if user has access
		if (!$this->hasAccess($module)) {
			return false;
		}

		// Execute the model
		$model = $this->execute($module, $params);

		// Render the view
		$render = $this->view->render($module, $model);

		// Get needed CSSs and JSs
		$title = $this->view->getGlobalVar('title');
		$css = $this->view->getGlobalVar('css');
		$js = $this->view->getGlobalVar('js');

		return array(
			'title' => $title,
			'css'   => $css,
			'js'    => $js,
			'tpl'   => $render
		);
	}

	/**
	 * Defines a new model for this controller
	 */
	public function setModel($model) {
		unset($this->model);
		$this->model = $model;
	}

	/**
	 * Get the model defined for this application
	 *
	 * @return Object
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * Defines a new view for this controller
	 */
	public function setView($view) {
		unset($this->view);
		$this->view = $view;
	}

	/**
	 * Get the view defined for this application
	 *
	 * @return Object
	 */
	public function getView() {
		return $this->view;
	}

	/**
	 * Check whether or not the current user has access to the asked module
	 *
	 * @param string $module Module to check
	 * @return bool True if the user has access, false if not
	 */
	public function hasAccess($module) {
		$session = System::getSession();

		$module_level = $this->getAccessLevel($module);
		$user_level = $session->isConnected() ? $_SESSION['access'] : 0;

		return $user_level >= $module_level;
	}

	/**
	 * Set the level needed to access the module
	 */
	public function setAccessLevel($module, $level) {
		$this->access[$module] = $level;
	}

	/**
	 * Get the level needed to access the module
	 *
	 * @return Int
	 */
	public function getAccessLevel($module) {
		return isset($this->access[$module]) ? $this->access[$module] : 0;
	}
}
?>
