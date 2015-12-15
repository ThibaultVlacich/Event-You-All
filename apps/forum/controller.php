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

     if (!empty($data['date_creation']) && $data['date_creation'] != '0000-00-00 00:00:00') {
       $date_debut_timestamp = strtotime($data['date_creation']);
       $data['date_creation'] = strftime('%a. %d %b. %Y', $date_debut_timestamp);
     } else {
       $data['date_creation'] = null;
     }
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


     $this->model->createEvent($data);
   }
 }

}

?>
