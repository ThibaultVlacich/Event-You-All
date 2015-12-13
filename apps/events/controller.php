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
     $event_id = $params[0];
     // Récupérer l'evenement lié depuis le model
     $data = $this->model->getEvent($event_id);

     if (!empty($data['date_debut']) && $data['date_debut'] != '0000-00-00 00:00:00') {
       $date_debut_timestamp = strtotime($data['date_debut']);
       $data['date_debut'] = date('D. d F Y', $date_debut_timestamp);
       $data['heure_debut'] = date('H:i', $date_debut_timestamp);
     } else {
       $data['date_debut'] = null;
       $data['heure_debut'] = null;
     }

     if (!empty($data['date_fin']) && $data['date_fin'] != '0000-00-00 00:00:00') {
       $date_fin_timestamp = strtotime($data['date_fin']);
       $data['date_fin'] = date('D. d F Y', $date_fin_timestamp);
       $data['heure_fin'] = date('H:i', $date_fin_timestamp);
     } else {
       $data['date_fin'] = null;
       $data['heure_fin'] = null;
     }

     // Retourner les infos récupérées
     return $data;
   }

 }

 function create() {

 }

 function create_confirm() {

   $data = Request::getAssoc(array('nom','date_de','time_de','date_fi','time_fi','nbpl','price','reg','adr','code_p','ville','pays','descript'));

   if (!in_array(null, $data, true)) {
     $data+=Request::getAssoc(array('bann','sujet','mclef','weborg','priv'));

     $date_debut=$data['date_de'].' '.$data['time_de'];
     $date_fin=$data['date_fi'].' '.$data['time_fi'];

     $data['priv'] = false;

     if (!empty($data['priv'])) {
       $data['priv'] = true;
     }

     $data['date_de'] = $date_debut;
     $data['date_fi'] = $date_fin;

     $this->model->createEvent($data);
   }
 }

 function index() {

 }

}

?>
