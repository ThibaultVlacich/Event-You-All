<?php
defined('EUA_VERSION') or die('Access denied');

class ForumController extends Controller {
  var $default_module = 'forum';

 function detail() {

 }
 function Forum(array $params){
   if (isset($params[0])) {
     $topic_id = intval($params[0]);

     // Récupérer l'evenement lié depuis le model
     if (!($data = $this->model->getTopic($topic_id))) {
       return array();
     }

     if (!empty($data['date_creation'])) {
       $date_debut_timestamp = strtotime($data['date_creation']);
       $data['date_creation'] = strftime('%a. %d %b. %Y', $date_creation_timestamp);
     }
      $data['creatorname'] = $this->model->getCreatorForTopic($data['id']);
     // Retourner les infos récupérées
     return $data;
   }
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
