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
    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/forum/script/create.js');
  }
  public function Topic() {
    $this->setTemplate('/apps/forum/views/Topic.php');
    $this->assign('css', Config::get('config.base').'/apps/forum/styles/Topic.css');
    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/forum/script/create.js');
  }
  public function create_confirm(){
  $this->setTemplate('/apps/forum/views/create_confirm.php');
}
public function sent_comment(){
$this->setTemplate('/apps/forum/views/sent_comment.php');
}
}

?>
