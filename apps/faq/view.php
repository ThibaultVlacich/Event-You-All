<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app faq.
 *
 * @package apps/faq
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-14-12-2015
 */

class FaqView extends View {
  function __construct() {
    // Here assign CSSs/JSs for all the app
    $this->assign('css', Config::get('config.base').'/apps/faq/styles/faq.css');
  }

  // Method for the module
  public function qw() {
    // Here assign CSSs/JSs for that method

    // The assign the view for the module
    $this->setTemplate('/apps/faq/views/faq.php');

  }
}

?>
