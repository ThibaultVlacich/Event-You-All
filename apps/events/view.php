<?php

class EventsView extends View {
  function __construct() {
      $this->assign('css', Config::get('config.base').'/apps/events/styles/cssPageevenement.css');
  }

  public function login() {
    $this->setTemplate('/apps/user/views/login.php');
  }
  public function detail() {
    $this->setTemplate('/apps/events/views/Page_evenement.php');
  }
  public function create() {
    $this->setTemplate('/apps/events/views/createvent.php');
	$this->assign('css', Config::get('config.base').'/apps/events/styles/createvent.css');
  }
   public function result_cr_event(){
	$this->setTemplate('/apps/events/views/createventre.php');
	 
 }
}

?>
