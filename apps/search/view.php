<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "Search".
 *
 * @package apps/search
 * @author Hugo Michard <hugomichard@isep.fr>
 * @version 1.1.0-dd-mm-yyyy
 */

// This file is not needed
class SearchView extends View {
  function __construct() {
    // Here assign CSSs/JSs for all the app
    $this->assign('css',Config::get('config.base').'/apps/search/styles/style.css');
    $this->assign('js',Config::get('config.base').'/apps/search/scripts/style.js');
  }


  // Method for the module
  public function basicsearch() {
    // Here assign CSSs/JSs for that method
    $this->assign('css',Config::get('config.base').'/apps/search/styles/search.css');

    // The assign the view for the module 
    $this->setTemplate('/apps/search/views/search.php');
  }


  public function advancedsearch() {
    //Here is assign CSSs and JSs for this method
    $this->assign('css',Config::get('config.base').'/apps/search/styles/search.css');

    //Here is assign the view for the module
    $this->setTemplate('/apps/search/views/search.php');

  }

}

?>
