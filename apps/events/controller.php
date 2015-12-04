<?php

class EventsController extends Controller {
  var $default_module = 'index';

 function detail() {

 }

 function create() {

 }

 function create_confirm() {
   $data = Request::getAssoc(array('nom','date_de','time_de',
   'date_fi','time_fi','nbpl','price',
   'reg'
   ,'adr','code_p','ville','pays','descript'
   ,'bann','comm','nott','sujet','condi'));

   if (!in_array(null, $data, true)) {
     $this->model->createEvent($data);
   }
 }

 function index() {

 }

}

?>
