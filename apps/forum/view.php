<?php

class ForumView extends View {
  function __construct() {

  }

  public function Forum() {
    $this->setTemplate('/apps/forum/views/Forum.php');
    $this->assign('css', Config::get('config.base').'/apps/forum/styles/cssForum.css');
  }
}

?>