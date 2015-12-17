<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "Search".
 *
 * @package apps/nameoftheapp
 * @author Hugo Michard <hugomichard@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

// This file is not needed
class SearchView extends View {
  function __construct() {
    // Here assign CSSs/JSs for all the app
    $this->assign('css',Config::get('config.base').'/apps/search/styles/style.css');
  }


  // Method for the module
  public function search() {
    // Here assign CSSs/JSs for that method
    $this->assign('css',Config::get('config.base').'/apps/search/styles/style.css');

    // The assign the view for the module
    $this->setTemplate('/apps/search/views/VIEW.php');
  }


}

?>
