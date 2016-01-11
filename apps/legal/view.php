<?php

class LegalView extends View {
  function __construct() {
$this->assign('css', Config::get('config.base').'/apps/legal/styles/legal.css');
  }

  public function Legal() {
    $this->setTemplate('/apps/legal/views/index.php');

  }
 }

?>
