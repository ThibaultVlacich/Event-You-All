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
   ,'adr','code_p','ville','pays','descript'));
   
//modifier date...
	print_r($data);
   if (!in_array(null, $data, true)) {
   	 $data+=Request::getAssoc(array('bann','sujet','mclef','weborg','priv'));
	 $date_debut=$data['date_de'].''.$data['time_de'];
	 $date_fin=$data['date_fi'].''.$data['time_fi'];
	 //no empty 
	 if ($data['priv'] =="")
	 {
	 $data['priv'] = false;
	 }
	 else
		 {
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
