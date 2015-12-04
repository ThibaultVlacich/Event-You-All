<?php

class EventsView extends View {
  function __construct() {

  }

  public function login() {
    $this->setTemplate('/apps/user/views/login.php');
  }
  public function detail() {
    $this->setTemplate('/apps/events/views/Page_evenement.php');
	$this->assign('css', Config::get('config.base').'/apps/events/styles/cssPageevenement.css');
  }
  public function create() {
    $this->setTemplate('/apps/events/views/createvent.php');
	$this->assign('css', Config::get('config.base').'/apps/events/styles/createvent.css');
  }
  public function index() {
    $this->setTemplate('/apps/events/views/home.php');
	$this->assign('css', Config::get('config.base').'/apps/events/styles/home.css');
  }
   public function create_confirm(){
	$this->setTemplate('/apps/events/views/createventre.php');

 }
}

?>
