<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "events".
 *
 * @package apps/events
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 1.1.0-11-12-2015
 */

class EventsView extends View {
  public function detail() {
    $this->setTemplate('/apps/events/views/detail.php');

    $this->assign('css', Config::get('config.base').'/librairies/camera/css/camera.css');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/detail.css');

    $this->assign('js', Config::get('config.base').'/librairies/camera/scripts/jquery.easing.1.3.js');
    $this->assign('js', Config::get('config.base').'/librairies/camera/scripts/camera.min.js');
    $this->assign('js', Config::get('config.base').'/apps/events/scripts/detail.js');
  }

  public function create() {
    $this->setTemplate('/apps/events/views/create.php');

    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');

    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/events/scripts/create.js');
  }

  public function modif() {
    $this->setTemplate('/apps/events/views/modif.php');
    $this->assign('css', Config::get('config.base').'/apps/events/styles/create.css');


    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/events/scripts/create.js');
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

  public function register() {
    $this->setTemplate('/apps/events/views/register.php');
  }

  public function unregister() {
    $this->setTemplate('/apps/events/views/unregister.php');
  }

  public function delete() {
    $this->setTemplate('/apps/events/views/delete.php');
  }

  public function rate() {
    $this->setTemplate('/apps/events/views/rate.php');
  }

  public function contactorganisateur(){
    $this->assign('css', Config::get('config.base').'/apps/events/styles/contactorganisateur.css');

    $this->setTemplate('/apps/events/views/contactorganisateur.php');
  }

  public function uploadphoto() {
    $this->assign('css', Config::get('config.base').'/apps/events/styles/uploadphoto.css');

    $this->setTemplate('/apps/events/views/uploadphoto.php');
  }

  public function reviewphoto() {
    $this->setTemplate('/apps/events/views/reviewphoto.php');
  }

}

?>
