<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "about".
 *
 * @package apps/about/admin
 * @author Louis
 * @version 0.1.0-dev-13-12-2015
 */

class AboutAdminController extends Controller {
  var $default_module = 'getabou';

  function getabou(){
    $data = $this->model->getAbou();
    return $data;
  }
  function modify(){
    $data = $this->model->getAbou();
    return $data;
  }

  function modifyConfirm(){
    $data = Request::getAssoc(array('text_modify'));
    $this->model->modifyConfirm($data);
    
  }






}

?>