<?php

class UserView extends View {
  function __construct() {
      $this->assign('css', Config::get('config.base').'/apps/user/styles/style.css');
  }

  public function login() {
    $this->setTemplate('/apps/user/views/login.php');
  }
	public function register() {
    $this->setTemplate('/apps/user/views/signup.php');
  }
}

?>
