<?php
defined('EUA_VERSION') or die('Access denied');

class ForumController extends Controller {
  var $default_module = 'forum';

 function detail() {

 }
 function Forum(array $params){
     $data = $this->model->getTopics(0, 5, 'date_creation', true);
       foreach ($data as $topic) {
         $date_creation_timestamp = strtotime($topic['date_creation']);
         $topic['date_creation'] = strftime('%d %b. %Y', $date_creation_timestamp);
       }
       $data = $this->model->getTopics(0, 10);

       $topics = array();

       foreach ($data as $topic) {
          $date_creation_timestamp = strtotime($topic['date_creation']);
          $topic['date_creation'] = strftime('%d %b. %Y', $date_creation_timestamp);

          $topics[] = $topic;
        }
        return array('topics' => $topics);
 }

 function Topic(array $params){
     $data = $this->model->getComments(0, 5, 'date', true);
       foreach ($data as $comment) {
         $date_timestamp = strtotime($comment['date']);
         $comment['date'] = strftime('%d %b. %Y', $date_timestamp);
       }
       $data = $this->model->getComments(0, 10);

       $comments = array();

       foreach ($data as $comment) {
          $date_timestamp = strtotime($comment['date']);
          $comment['date'] = strftime('%d %b. %Y', $date_timestamp);

          $comments[] = $comment;
        }
        return array('comments' => $comments);
 }

 function create() {

 }

 function create_confirm() {

   $data = Request::getAssoc(array('sujet','administrateur','evenement','date_creation'));

   if (!in_array(null, $data, true)) {
     $date_creation = $data['date_creation'];

     $data['date_creation'] = $date_creation;


     $this->model->createTopic($data);
     return array ('id' => $id_topic);
   }
 }
 function sent_comment() {

   $data = Request::getAssoc(array('message','date','id_createur','id_topic'));

   if (!in_array(null, $data, true)) {
     $date = $data['date'];

     $data['date'] = $date;


     $this->model->Topic($data);
     return array ('id' => $id_topic);
   }
 }
}

?>
