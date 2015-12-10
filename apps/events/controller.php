<?php

class EventsController extends Controller {
  var $default_module = 'index';

 function detail() {

 }

 function create() {

 }

 function create_confirm() {
   $data = Request::getAssoc(array('nom','date_debut','date_fin','capacite','prix','prive',
      'site_web','region','adresse','code_postal','ville,pays','description','banniere','mot_clef'))

   if (!in_array(null, $data, true)) {
     $this->model->createEvent($data);
   }
 }

 function index() {

 }

}

?>
