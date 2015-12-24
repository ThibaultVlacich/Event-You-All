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
    $this->assign('js', 'https://www.google.com/recaptcha/api.js');

    $this->setTemplate('/apps/user/views/register.php');
  }

  public function lostpassword(){
    $this->assign('css',Config::get('config.base').'/apps/user/styles/lostpassword.css');

    $this->setTemplate('/apps/user/views/lostpassword.php');
  }

  public function myprofil(){
    $this->assign('css',Config::get('config.base').'/apps/user/styles/myprofil.css');

    $this->setTemplate('/apps/user/views/myprofil.php');
  }
}
?>
