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
    $data = $this->model->getFaq();
    return $data;
  }
  function modify(){
    $data = $this->model->getFaq();
    return $data;
  }

  function modifyConfirm(){

    $compteur = $this->model->getCompteur();
      foreach ($compteur as $id){


      $data = Request::getAssoc(array("text_modifyQ".$id['compteur'],"text_modifyR".$id['compteur']));

      $this->model->modifyConfirm($data);
    }



  }






}

?>
