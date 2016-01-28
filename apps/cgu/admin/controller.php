<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "events".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-13-12-2015
 */

class CguAdminController extends Controller {
  var $default_module = 'modify';
  var $access = array(
    'all' => 3
  );

  function modify() {
    $data = $this->model->getCgu();
    return $data;
  }

  function modifyConfirm() {
    $data = Request::getAssoc(array('text_modify'));

    $this->model->modifyConfirm($data);
  }
}
?>
