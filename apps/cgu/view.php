<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "cgu".
 *
 * @package apps/cgu/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-13-12-2015
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
