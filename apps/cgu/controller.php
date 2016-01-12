<?php
/**
 * This is the Controller for the cgu.
 *
 * @package apps/cgu
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-31-12-2015
 */

class CguController extends Controller {
  var $default_module = 'cgu';

 
 function cgu(){

     $data = $this->model->cgu();
     return $data;

 }

}

?>
