<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "User".
 *
 * @package apps/user
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-03-12-2015
 */

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

  public function passwordlost() {
    $this->setTemplate('/apps/user/views/lostpassword.php');
  }

  public function myprofil() {
    $this->assign('css',Config::get('config.base').'/apps/user/styles/myprofil.css');

    $this->setTemplate('/apps/user/views/myprofil.php');
  }

  public function updateProfil() {
    $this->assign('css',Config::get('config.base').'/apps/user/styles/myprofil.css');

    $this->setTemplate('/apps/user/views/updateProfil.php');
  }

  public function mesevents(){
    $this->assign('css',Config::get('config.base').'/apps/user/styles/mesevents.css');

    $this->setTemplate('/apps/user/views/mesevents.php');
  }

}
?>
