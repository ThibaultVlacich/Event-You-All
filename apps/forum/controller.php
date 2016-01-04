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
         $createur = $this->model->getCreatorForTopic($topic['id_createur']);
       }
       $data = $this->model->getTopics(0, 10);

       $topics = array();

       foreach ($data as $topic) {
          $date_creation_timestamp = strtotime($topic['date_creation']);
          $topic['date_creation'] = strftime('%d %b. %Y', $date_creation_timestamp);

          $topics[] = $topic;
        }
        return array('topics' => $topics, 'createur'=>$createur['nickname']);
 }

 function Topic(array $params){
   if (isset($params[0])) {
    $topic_id = intval($params[0]);
    if (!($data = $this->model->getTopic($topic_id))) {
      return array();
    }

     $data['comment'] = $this->model->getComments(0, 5, 'date', true);
       foreach ($data['comment'] as $comment) {
         $date_timestamp = strtotime($comment['date']);
         $comment['date'] = strftime('%d %b. %Y', $date_timestamp);
       }
       $data['comment'] = $this->model->getComments(0, 10);

       $comments = array();

       foreach ($data['comment'] as $comment) {
          $date_timestamp = strtotime($comment['date']);
          $comment['date'] = strftime('%d %b. %Y', $date_timestamp);

          $comments[] = $comment;
        }
        return array($data,'comments' => $comments);
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
