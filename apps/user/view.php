<?php

class UserView extends View {
  function __construct() {
      $this->assign('css', Config::get('config.base').'/apps/user/styles/login.css');
  }

  public function login() {
    $this->setTemplate('/apps/user/views/login.php');
  }
}

?>