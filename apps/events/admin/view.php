<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

  class EventsAdminView extends View {
  public function index() {
    $this->setTemplate('/apps/events/admin/views/index.php');
    $this->assign('css', Config::get('config.base').'/apps/events/admin/styles/home.css');
  }
  public function modif() {
    $this->setTemplate('/apps/events/admin/views/modif.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');


    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/events/scripts/create.js');
  }
  public function modif_confirm(){
    $this->setTemplate('/apps/events/admin/views/modifsent.php');
  }
}

?>
