<?php

class ForumView extends View {
  function __construct() {

  }

  public function Forum() {
    $this->setTemplate('/apps/forum/views/Forum.php');
    $this->assign('css', Config::get('config.base').'/apps/forum/styles/cssForum.css');
  }
  public function create() {
    $this->setTemplate('/apps/forum/views/createTopic.php');
    $this->assign('css', Config::get('config.base').'/apps/forum/styles/createTopic.css');
  }
  public function Topic() {
    $this->setTemplate('/apps/forum/views/Topic.php');
    $this->assign('css', Config::get('config.base').'/apps/forum/styles/Topic.css');
  }
}

?>
