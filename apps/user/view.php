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

  public function profil(){
	  $this->setTemplate('/apps/user/views/profil.php');
  }

  public function oublimdp(){
    $this->assign('css',Config::get('config.base').'/apps/user/styles/mdpoubli.css');

    $this->setTemplate('/apps/user/views/mdpoubli.php');
  }
}
?>
