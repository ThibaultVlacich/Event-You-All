<?php

class AboutView extends View {
  function __construct() {
$this->assign('css', Config::get('config.base').'/apps/about/styles/about.css');
  }

  public function about() {
    $this->setTemplate('/apps/about/views/about.php');

  }
 }

?>
