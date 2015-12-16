<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "events".
 *
 * @package apps/events
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 0.1.0-dev-11-12-2015
 */

class EventsController extends Controller {
  var $default_module = 'index';

  var $access = array(
    'create'         => 1,
    'create_confirm' => 1
  );

 function detail(array $params) {

   if (isset($params[0])) {
     $event_id = intval($params[0]);

     // Récupérer l'evenement lié depuis le model
     if (!($data = $this->model->getEvent($event_id))) {
       return array();
     }

     if (!empty($data['date_debut']) && $data['date_debut'] != '0000-00-00 00:00:00') {
       $date_debut_timestamp = strtotime($data['date_debut']);
       $data['date_debut'] = strftime('%a. %d %b. %Y', $date_debut_timestamp);
       $data['heure_debut'] = strftime('%H:%M', $date_debut_timestamp);
     } else {
       $data['date_debut'] = null;
       $data['heure_debut'] = null;
     }

     if (!empty($data['date_fin']) && $data['date_fin'] != '0000-00-00 00:00:00') {
       $date_fin_timestamp = strtotime($data['date_fin']);
       $data['date_fin'] = strftime('%a. %d %b. %Y', $date_fin_timestamp);
       $data['heure_fin'] = strftime('%H:%M', $date_fin_timestamp);
     } else {
       $data['date_fin'] = null;
       $data['heure_fin'] = null;
     }

     // Get linked articles
     $data['articles'] = $this->model->getArticlesForEvent($data['id']);

     // Retourner les infos récupérées
     return $data;
   }

 }

 function create() {

 }

 function create_confirm() {

   $data = Request::getAssoc(array('nom','date_de','time_de','date_fi','time_fi','nbpl','price','reg','adr','code_p','ville','pays','descript','theme','type'));

   if (!in_array(null, $data, true)) {
     $data += Request::getAssoc(array('bann','sujet','mclef','weborg','priv'));

     $date_debut = $data['date_de'].' '.$data['time_de'];
     $date_fin = $data['date_fi'].' '.$data['time_fi'];

     $data['priv'] = false;
//évite les bugs liés au fait d'avoir des champs nuls
     if (!empty($data['priv'])) {
       $data['priv'] = true;
     }
	 if (empty($data['bann'])) {
       $data['bann'] = '';
     }
	 if (empty($data['mclef'])) {
       $data['mclef'] = '';
     }

     $data['date_de'] = $date_debut;
     $data['date_fi'] = $date_fin;

     $id_event = $this->model->createEvent($data);

	 return array('id' => $id_event);
   }
 }

 function index() {
   $data = $this->model->getEvents();

   $events = array();

   foreach ($data as $event) {
     if (!empty($event['date_debut']) && $event['date_debut'] != '0000-00-00 00:00:00') {
       $date_debut_timestamp = strtotime($event['date_debut']);
       $event['date_debut'] = strftime('%d %b. %Y', $date_debut_timestamp);
       $event['heure_debut'] = strftime('%H:%M', $date_debut_timestamp);
     } else {
       $event['date_debut'] = null;
       $event['heure_debut'] = null;
     }

     if (!empty($event['date_fin']) && $event['date_fin'] != '0000-00-00 00:00:00') {
       $date_fin_timestamp = strtotime($event['date_fin']);
       $event['date_fin'] = strftime('%d %b. %Y', $date_fin_timestamp);
       $event['heure_fin'] = strftime('%H:%M', $date_fin_timestamp);
     } else {
       $event['date_fin'] = null;
       $event['heure_fin'] = null;
     }

     $events[] = $event;
   }

   return $events;
 }

}

?>
