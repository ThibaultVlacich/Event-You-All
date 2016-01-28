<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "user".
 *
 * @package apps/user/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-12-01-2016
 */

class UserAdminView extends View {

  public function index() {
    $this->assign('css', Config::get('config.base').'/apps/user/admin/styles/index.css');

    $this->setTemplate('/apps/user/admin/views/index.php');
  }

  public function modify() {
    $this->assign('css', Config::get('config.base').'/apps/user/admin/styles/modify.css');

    $this->setTemplate('/apps/user/admin/views/modify.php');
  }

  public function delete() {
    $this->setTemplate('/apps/user/admin/views/delete.php');
  }

}

?>
