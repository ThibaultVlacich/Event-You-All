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
}

?>
