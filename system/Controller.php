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

	 function __construct() {
		 $route = Route::getRoute();

		 $module = isset($route['params'][0]) ? $route['params'][0] : $this->default_module;

		 if(method_exists($this, $module)) {
			 call_user_func(array($this, $module));
		 } else if (!empty($this->default_module) && method_exists($this, $this->default_module)) {
			 call_user_func(array($this, $this->default_module));
		 }
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
}
?>
