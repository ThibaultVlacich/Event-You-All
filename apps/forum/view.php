<?php
/**
 * This is the View for the app "forum".
 *
 * @package apps/forum
 * @author Léo Plouvier <leo.plouvier@isep.fr>
 * @version 1.1.0-07-01-2015
 */

class ForumView extends View {
  public function forum() {
    $this->setTemplate('/apps/forum/views/Forum.php');
    $this->assign('css', Config::get('config.base').'/apps/forum/styles/cssForum.css');
  }

  public function create() {
    $this->setTemplate('/apps/forum/views/createTopic.php');
    $this->assign('css', Config::get('config.base').'/apps/forum/styles/createTopic.css');
    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/forum/script/createcom.js');
  }

  public function topic() {
    $this->setTemplate('/apps/forum/views/Topic.php');
    $this->assign('css', Config::get('config.base').'/apps/forum/styles/Topic.css');
    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/forum/script/createtop.js');
  }

  public function create_confirm(){
  $this->setTemplate('/apps/forum/views/create_confirm.php');
  }

  public function send_comment(){
    $this->setTemplate('/apps/forum/views/sent_comment.php');
  }
  public function delete(){
    $this->setTemplate('/apps/forum/views/delete.php');
  }
  public function deleteComment(){
    $this->setTemplate('/apps/forum/views/deleteComment.php');
  }
}

?>
