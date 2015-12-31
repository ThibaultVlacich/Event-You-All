<?php

class AboutView extends View {
  function __construct() {
$this->assign('css', Config::get('config.base').'/apps/about/styles/A propos.css');
  }

  public function About() {
    $this->setTemplate('/apps/about/views/A propos.php');

  }
 }

?>
