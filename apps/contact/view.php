<?php

class UserView extends View {
  function __construct() {
    $this->assign('css', Config::get('config.base').'/apps/contact/styles/style.css');
    $this->assign('js', Config::get('config.base').'/apps/contact/scripts/contact.js');
  }


  public function contact() {

    $this->setTemplate('/apps/contact/views/contact.php');
  }


}

?>
