<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "forum".
 *
 * @package apps/forum
 * @author Léo Plouvier <leo.plouvier@isep.fr>
 * @version 1.1.0-07-01-2015
 */

class ForumController extends Controller {
  var $default_module = 'forum';
  var $access = array(
    'create' => 1,
    'create_confirm' => 1,
    'send_comment' => 1,
    'delete' => 2,
    'deleteComment' => 2
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

      $topic['createur'] = $this->model->getCreatorForTopic($topic['id']);

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
   $n = 10; // Number of comments per page
   $page = 1; // Current page

   if ((isset($params[0]) && isset($params[1]) && $params[1]== 'page')) {
     $page = intval($params[2]);

    }
    $topic_id = intval($params[0]);
      $data = $this->model->getTopic($topic_id);
      $datecrea_timestamp = strtotime($data['date_creation']);
      $datecrea=strftime('%d %b %Y', $datecrea_timestamp);
      $titre = $data['titre'];
      $createurtop = $this->model->getCreatorForTopic($topic_id);
      $description= $data['description'];
      $photoprofil=$this->model->getAvatarForCreator($data['id_createur']);

      if(empty($photoprofil['photoprofil'])){
        $photoprofil['photoprofil'] = Config::get('config.base').'/apps/user/images/photoinconnu.png' ;
      }
      $comments = $this->model->getComments($topic_id,($page-1)*$n, $n);

      foreach ($comments as $index => $comment) {
         $date_timestamp = strtotime($comment['date']);
         $comments[$index]['photoprofil'] = $this->model->getAvatarForCreator($comment['id_createur']);
         if(empty($comments[$index]['photoprofil']['photoprofil'])){
           $comments[$index]['photoprofil']['photoprofil'] = Config::get('config.base').'/apps/user/images/photoinconnu.png' ;
       }
         $comments[$index]['date'] = strftime('%d %b %Y', $date_timestamp);
         $comments[$index]['createur'] = $this->model->getCreatorForComments($comment['id']);
      }
      return array(
        'id_topic' => $topic_id,
        'comments' => $comments,
        'createurtop' => $createurtop['nickname'],
        'date_creation' => $datecrea,
        'titre' => $titre,
        'photoprofil' => $photoprofil,
        'description' =>$description,
        'current_page' => $page,
        'per_page'     => $n,
        'total'        => $this->model->countMessages($topic_id)
      );
    }

  function create() {

  }

  function create_confirm() {

    $data = Request::getAssoc(array('titre','description'));

    if (!in_array(null, $data, true)) {
      $id_topic = $this->model->createTopic($data);
      //print_r($data);
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

  function delete(array $params) {
    if(!isset($params[0])) {
      return false;
    }

    $topic_id = intval($params[0]);
    $data = $this->model->getTopic($topic_id);
    $this->model->deleteTopic($data['id']);
    }

    function deleteComment(array $params) {
      if(!isset($params[0])) {
        return false;
      }

      $comment_id = intval($params[0]);
      $data = $this->model->getcomment($comment_id);
      $this->model->deleteComment($data['id']);
      return array('id' => $data['id_topic']);
      }
}

?>
