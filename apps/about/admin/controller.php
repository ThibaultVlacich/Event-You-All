<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "about".
 *
 * @package apps/about/admin
 * @author Louis
 * @version 1.1.0-13-12-2015
 */

class AboutAdminController extends Controller {
  var $default_module = 'modify';
  var $access = array(
    'all' => 3
  );

  function modify(){
    $data = $this->model->getAbout();

    return $data;
  }

  function modifyConfirm(){
    $data = Request::getAssoc(array('text_modify'));

    $this->model->modifyConfirm($data);
  }
}
?>
