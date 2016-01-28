<?php
/**
 * This is the Controller for the app about.
 *
 * @package apps/about
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-31-12-2015
 */

class LegalController extends Controller {
  var $default_module = 'legal';


 function legal(){
     $mail = Config::get('config.email');
 }

}

?>
