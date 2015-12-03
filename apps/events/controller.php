<?php

class EventsController extends Controller {
  var $default_module = 'index';

 function detail() {

 }

  function create() {
    $data = Request::getAssoc(array('nom','mail','theme','type','date_de','time_de',
    'date_fi','time_fi','nbpl','price','mclef','priv','gpadm','padm','telorg',
    'blist','norg','nentr','partn','weborg','reg'
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
