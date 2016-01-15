<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "faq".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

class FaqAdminController extends Controller {
  var $default_module = 'getFaq';

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
}



?>
