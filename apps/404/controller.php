<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app 404.
 *
 * @package apps/404
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-21-12-2015
 */

class NotFoundController extends Controller {
  var $default_module = 'index';

  public function index(array $params) {
    return array();
  }
}

?>
