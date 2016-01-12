<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "cgu".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

class CguView extends View {
  function __construct() {

  }

  public function Cgu() {
    $this->assign('css', Config::get('config.base').'/apps/cgu/styles/cgu.css');
    $this->setTemplate('/apps/cgu/views/cgu.php');

  }
 }

?>
