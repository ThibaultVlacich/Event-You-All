<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-13-12-2015
 */

class EventsAdminView extends View {
  public function index() {
    $this->setTemplate('/apps/events/admin/views/index.php');
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

  //---------------THEME------------------------------
  public function themes(){
    $this->setTemplate('/apps/events/admin/views/theme.php');
    $this->assign('css', Config::get('config.base').'/apps/events/admin/styles/home.css');
  }

  public function modiftheme() {
    $this->setTemplate('/apps/events/admin/views/modiftheme.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');
  }

  public function addtheme() {
    $this->setTemplate('/apps/events/admin/views/ajoutheme.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');
  }


  //-----------------------TYPE-------------------------------------------
  public function types(){
    $this->setTemplate('/apps/events/admin/views/type.php');
    $this->assign('css', Config::get('config.base').'/apps/events/admin/styles/home.css');
  }

  public function modiftype() {
    $this->setTemplate('/apps/events/admin/views/modiftype.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');
  }

  public function addtype() {
    $this->setTemplate('/apps/events/admin/views/ajoutype.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');
  }

  //-----------------------REGION-------------------------------------------
  public function regions(){
    $this->setTemplate('/apps/events/admin/views/region.php');
    $this->assign('css', Config::get('config.base').'/apps/events/admin/styles/home.css');
  }

  public function modifregion() {
    $this->setTemplate('/apps/events/admin/views/modifregion.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');
  }

  public function addregion() {
    $this->setTemplate('/apps/events/admin/views/ajouregion.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');
  }
}

?>
