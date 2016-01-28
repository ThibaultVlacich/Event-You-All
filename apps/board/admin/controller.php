<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the admin Controller for the app "board".
 *
 * @package apps/board/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-03-01-2016
 */

class BoardAdminController extends Controller {
  var $default_module = 'board';
  var $access = array(
    'all' => 3
  );

  public function board() {
    return array(
      'messages'     => $this->model->getMessages(0, 50, 'date', false),
      'userCount'    => $this->model->userCount(),
      'eventCount'   => $this->model->eventCount(),
      'articleCount' => $this->model->articleCount(),
      'topicCount'   => $this->model->topicCount(),
      'messageCount' => $this->model->messageCount()
    );
  }

  public function sendmessage() {
    $message = Request::get('message');

    if (!empty($message)) {
      $this->model->addMessage($message);
    }

    header('Location: '.Config::get('config.base').'/admin/board');

    exit;
  }
}

?>
