<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app faq.
 *
 * @package apps/faq
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-14-12-2015
 */

class FaqController extends Controller {
  var $default_module = 'qw';


 function qw(){

     $data = $this->model->qw();
     return $data;
  }
}

?>
