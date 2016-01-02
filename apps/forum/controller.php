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
 /*function Forum() {
    $data = $this->model->getTopics();

    $events = array();

    foreach ($data as $event) {
        $date_creation_timestamp = strtotime($event['date_creation']);
        $topic['date_creation'] = strftime('%d %b. %Y', $date_creation_timestamp);

    $topics[]= $topic;
  }

  return $topics;*/
}

?>
