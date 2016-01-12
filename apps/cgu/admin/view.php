<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

  class CguAdminView extends View {
    function __construct() {

    }
  public function get() {
    $this->setTemplate('/apps/cgu/admin/views/index.php');
    $this->assign('css', Config::get('config.base').'/apps/cgu/admin/styles/cgu.css');
  }
  public function modify() {
    $this->setTemplate('/apps/cgu/admin/views/modify.php');
    $this->assign('css', Config::get('config.base').'/apps/cgu/admin/styles/cgu.css');
    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/cgu/admin/scripts/modify.js');
  }


}

?>
