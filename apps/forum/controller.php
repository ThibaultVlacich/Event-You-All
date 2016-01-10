<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "forum".
 *
 * @package apps/forum
 * @author Léo Plouvier <leo.plouvier@isep.fr>
 * @version 0.1.0-dev-07-01-2015
 */

class ForumController extends Controller {
  var $default_module = 'forum';
  var $access = array(
    'create' => 1,
    'create_confirm' => 1,
    'send_comment' => 1
  );

  function forum(array $params){
    $n = 10; // Number of topics per page
    $page = 1; // Current page

    // Get the current page from URL
    if ((isset($params[0]) && $params[0] == 'page') && isset($params[1])) {
      $page = intval($params[1]);
    }

    $data = $this->model->getTopics(($page-1)*$n, $n);

    $topics = array();

    foreach ($data as $topic) {
      $date_creation_timestamp = strtotime($topic['date_creation']);
      $topic['date_creation'] = strftime('%d %b. %Y', $date_creation_timestamp);

      $topic['createur'] = $this->model->getCreatorForTopic($topic['id_createur']);

      $topics[] = $topic;
    }

    return array(
      'topics'       => $topics,
      'total'        => $this->model->countTopics(),
			'current_page' => $page,
			'per_page'     => $n
    );
 }

 function topic(array $params){
    if (isset($params[0])) {
      $topic_id = intval($params[0]);

      $data = $this->model->getTopic($topic_id);
      $datecrea = $data['date_creation'];
      $titre = $data['titre'];
      $createurtop = $this->model->getCreatorForTopic($data['id_createur']);
      $description= $data['description'];

      $comments = $this->model->getComments($topic_id, 0, 10);

      foreach ($comments as &$comment) {
         $date_timestamp = strtotime($comment['date']);
         $comment['date'] = strftime('%d %b %Y', $date_timestamp);
         $comment['createur'] = $this->model->getCreatorForComments($comment['id_createur']);
      }

      return array(
        'id_topic' => $topic_id,
        'comments' => $comments,
        'createurtop' => $createurtop['nickname'],
        'date_creation' => $datecrea,
        'titre' => $titre,
        'description' =>$description
      );
    }
  }

  function create() {

  }

  function create_confirm() {

    $data = Request::getAssoc(array('titre','description'));

    if (!in_array(null, $data, true)) {
      $id_topic = $this->model->createTopic($data);
      return array ('id' => $id_topic);
    }
  }

  function send_comment(array $params) {
    if(!isset($params[0])) {
      return false;
    }

    $topic_id = intval($params[0]);

    $data = Request::getAssoc(array('message'));

    if (!in_array(null, $data, true)) {
      $this->model->addComment($topic_id, $data);

      return array('id' => $topic_id);
    }
  }
}

?>
