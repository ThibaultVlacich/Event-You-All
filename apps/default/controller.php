<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "NAME OF THE APP".
 *
 * @package apps/nameoftheapp
 * @author Name of the author <author@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

// -> Need to replace here "Default" by the name of the app (capitalized)
class DefaultController extends Controller {
  // Optional
  var $default_module = 'name of the module';

  // Method for the module
  public function module(array $params) {

    // Need to return an array of datas
    return array();
  }
}

?>