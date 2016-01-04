<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the admin Controller for the app "board".
 *
 * @package apps/board/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-03-01-2016
 */

class BoardAdminController extends Controller {
  var $default_module = 'board';
  var $access = array(
    'all' => 3
  );

  public function board(array $params) {
    return array();
  }
}

?>
