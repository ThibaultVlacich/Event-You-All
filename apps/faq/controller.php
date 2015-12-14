<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app faq.
 *
 * @package apps/faq
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-14-12-2015
 */

class FaqController extends Controller {
  var $default_module = 'index';

  public function index(array $params) {
    //recuperer données de model TO DO
    $quest=$this->model->getFaq();
    // Need to return an array of datas
    return $quest;
  }
}

?>
