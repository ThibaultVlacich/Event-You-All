<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "cgu".
 *
 * @package apps/events/admin
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-13-12-2015
 */

class CguAdminView extends View {
  /*modify page*/
  public function modify() {
    $this->setTemplate('/apps/cgu/admin/views/modify.php');

    $this->assign('css', Config::get('config.base').'/apps/cgu/admin/styles/cgu.css');

    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/cgu/admin/scripts/modify.js');
  }

  /*confirm page*/
  public function modifyConfirm(){
    $this->setTemplate('/apps/cgu/admin/views/modifyconfirm.php');
    
    $this->assign('css', Config::get('config.base').'/apps/cgu/admin/styles/cgu.css');
  }
}

?>
