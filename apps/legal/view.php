<?php

class LegalView extends View {
  function __construct() {
$this->assign('css', Config::get('config.base').'/apps/legal/styles/legal.css');
  }

  public function legal() {
    $this->setTemplate('/apps/legal/views/legal.php');

  }
 }

?>
