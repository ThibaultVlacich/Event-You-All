<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "about".
 *
 * @package apps/about/admin
 * @author Louis
 * @version 1.0.0-13-12-2015
 */

  class AboutAdminView extends View {
    function __construct() {

    }
  /*default page*/
  public function getabou() {
    $this->setTemplate('/apps/about/admin/views/getabou.php');
    $this->assign('css', Config::get('config.base').'/apps/cgu/admin/styles/cgu.css');
  }
  /*modify page*/
  public function modify() {
    $this->setTemplate('/apps/about/admin/views/modify.php');
    $this->assign('css', Config::get('config.base').'/apps/cgu/admin/styles/cgu.css');
    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/cgu/admin/scripts/modify.js');
  }
  /*confirm page*/
  public function modifyConfirm(){
    $this->setTemplate('/apps/about/admin/views/modifyconfirm.php');
    $this->assign('css', Config::get('config.base').'/apps/cgu/admin/styles/cgu.css');

  }


}

?>
