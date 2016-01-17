<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "events".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.2.0-dev-13-12-2015
 */

class CguAdminController extends Controller {
  var $default_module = 'getCgu';
  var $access = array(
    'all' => 3
  );

  function getCgu(){
    $data = $this->model->getCgu();
    return $data;
  }
  function modify(){
    $data = $this->model->getCgu();
    return $data;
  }

  function modifyConfirm(){
    $data = Request::getAssoc(array('text_modify'));

    $this->model->modifyConfirm($data);

  }






}

?>
