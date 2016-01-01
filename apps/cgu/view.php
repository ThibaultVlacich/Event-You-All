<?php

class CguView extends View {
  function __construct() {
$this->assign('css', Config::get('config.base').'/apps/cgu/styles/cgu.css');
  }

  public function Cgu() {
    $this->setTemplate('/apps/cgu/views/index.php');

  }
 }

?>
