<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "NAME OF THE APP".
 *
 * @package apps/nameoftheapp
 * @author Name of the author <author@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

// This file is not needed
class NewslettersView extends View {
  function __construct() {
    // Here assign CSSs/JSs for all the app
    // EX : $this->assign('css', Config::get('config.base').'/apps/user/styles/style.css');
  }

  // Method for the module
  public function module() {
    // Here assign CSSs/JSs for that method
    // EX : $this->assign('css', Config::get('config.base').'/apps/user/styles/style.css');

    // The assign the view for the module
    $this->setTemplate('/apps/NAMEOFTHEAPP/views/VIEW.php');
  }
}

?>
