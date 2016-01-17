<?php
/**
 * This is the Controller for the app about.
 *
 * @package apps/about
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.2.0-dev-31-12-2015
 */

class AboutController extends Controller {
  var $default_module = 'about';

 
 function about(){
     $data = $this->model->cgu();
     return $data;
 }

}

?>
