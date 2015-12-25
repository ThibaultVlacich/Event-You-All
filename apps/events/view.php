<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "events".
 *
 * @package apps/events
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 0.1.0-dev-11-12-2015
 */

class EventsView extends View {
  public function detail() {
    $this->setTemplate('/apps/events/views/detail.php');

  	$this->assign('css', Config::get('config.base').'/apps/events/styles/detail.css');
    $this->assign('js', Config::get('config.base').'/apps/events/scripts/detail.js');
  }

  public function create() {
    $this->setTemplate('/apps/events/views/createvent.php');

    $this->assign('css', Config::get('config.base').'/apps/events/styles/createvent.css');

    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/events/scripts/create.js');
  }
    public function modif() {
    $this->setTemplate('/apps/events/views/modifevent.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/createvent.css');
  }

  public function index() {
    $this->setTemplate('/apps/events/views/home.php');

    $this->assign('css', Config::get('config.base').'/apps/events/styles/home.css');
    $this->assign('js', Config::get('config.base').'/librairies/jquery.slides.js');
    $this->assign('js', Config::get('config.base').'/apps/events/scripts/home.js');
  }

  public function create_confirm(){
    $this->setTemplate('/apps/events/views/createventre.php');
 }
  public function modif_confirm(){
    $this->setTemplate('/apps/events/views/modifsent.php');
 }
}

?>
