<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "faq".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-13-12-2015
 */

class FaqAdminController extends Controller {
  var $default_module = 'getFaq';
  var $access = array(
    'all' => 3
  );

  function getFaq(){
    $data = $this->model->getAllFaq();
    return $data;
  }
  function modify(array $params){
    if (isset($params[0])){
      $id=intval($params[0]);
    $data = $this->model->getFaq($id);
    return $data;
  }
  }

  function modifyConfirm(array $params){

    if (isset($params[0])){
      $id=intval($params[0]);



      $data = Request::getAssoc(array("text_modifyQ","text_modifyR"));
      $data['id']=$id;


      $this->model->modifyConfirm($data);

}
}
function add(){

}
function confirmAdd(){
  $data= Request::getAssoc(array("text_modifyQ","text_modifyR"));
    $this->model->confirmAdd($data);
}
function delete(array $params){
  if (isset($params[0])) {
    $id_event = intval($params[0]);
    $delete = $this->model->deleteFaq($id_event);

    header('Location: '.Config::get('config.base').'/admin/faq');
  }
}
}



?>
