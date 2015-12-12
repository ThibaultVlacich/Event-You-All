<?php

class UserView extends View {
  function __construct() {
    $this->assign('css', Config::get('config.base').'/apps/user/styles/style.css');
  }

  public function login() {
    $this->setTemplate('/apps/user/views/login.php');
  }

  public function register() {
    $this->assign('js', Config::get('config.base').'/apps/user/scripts/register.js');

    $this->setTemplate('/apps/user/views/register.php');
  }
}

?>
