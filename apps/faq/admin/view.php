<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "faq".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-13-12-2015
 */

  class FaqAdminView extends View {
    function __construct() {

    }
  /*default page*/
  public function getFaq() {
    $this->setTemplate('/apps/faq/admin/views/getFaq.php');
    $this->assign('css', Config::get('config.base').'/apps/faq/admin/styles/faq.css');
  }
  /*modify page*/
  public function modify() {
    $this->setTemplate('/apps/faq/admin/views/modify.php');
    $this->assign('css', Config::get('config.base').'/apps/faq/admin/styles/faq.css');

    $this->assign('js', Config::get('config.base').'/apps/faq/admin/scripts/modify.js');
  }
  /*confirm page*/
  public function modifyConfirm(){
    $this->setTemplate('/apps/faq/admin/views/modifyconfirm.php');
    $this->assign('css', Config::get('config.base').'/apps/faq/admin/styles/faq.css');

  }
  public function add(){
    $this->setTemplate('/apps/faq/admin/views/add.php');
    $this->assign('css', Config::get('config.base').'/apps/faq/admin/styles/faq.css');

  }
  public function confirmAdd(){

    $this->setTemplate('/apps/faq/admin/views/confirmAdd.php');
    $this->assign('css', Config::get('config.base').'/apps/faq/admin/styles/faq.css');

  }


}

?>
