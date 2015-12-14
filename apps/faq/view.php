<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app faq.
 *
 * @package apps/faq
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-14-12-2015
 */

class FaqView extends View {
  function __construct() {
    // Here assign CSSs/JSs for all the app
    // EX : $this->assign('css', Config::get('config.base').'/apps/user/styles/style.css');
  }

  // Method for the module
  public function index() {
    // Here assign CSSs/JSs for that method
    // EX : $this->assign('css', Config::get('config.base').'/apps/user/styles/style.css');

    // The assign the view for the module
    $this->setTemplate('/apps/faq/views/faq.php');
  }
}

?>
