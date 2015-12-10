<?php

class EventsController extends Controller {
  var $default_module = 'index';

 function detail() {

 }

 function create() {

 }

 function create_confirm() {
   $data = Request::getAssoc(array('nom','date_de','time_de',
   'date_fi','time_fi','nbpl','price','reg'
   ,'adr','code_p','ville','pays','descript'
   ,'bann','sujet','mclef','weborg'));
   
//modifier date...
   if (!in_array(null, $data, true)) {
	 $date_debut=$data['date_de'].$data['time_de'];
	 $date_fin=$data['date_fi'].$data['time_fi'];
     $this->model->createEvent($data);
   }
 }

 function index() {

 }

}

?>
