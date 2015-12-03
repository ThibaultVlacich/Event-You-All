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
		 } else if (!empty($this->default_module) && method_exists($this, $this->default_module)) {
			 return $this->$default_module($params);
		 }
	 }

	 /**
	  * Render the template
		*
		* @return string content of the rendered app
		*/
	public final function render() {
		$route = Route::getRoute();
		$params = $route['params'];

		// Extract the name of the module from the parameters
		$module = isset($params[0]) ? $params[0] : $this->default_module;

		// Execute the model
		$model = $this->execute($module, $params);

		// Render the view
		$render = $this->view->render($module, $model);

		// Get needed CSSs and JSs
		$css = $this->view->getGlobalVars('css');
		$js = $this->view->getGlobalVars('js');

		return array(
			'css' => $css,
			'js'  => $js,
			'tpl' => $render
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
}
?>
