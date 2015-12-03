<?php

class EventsController extends Controller {
  var $default_module = 'lol';

  /**
	 * The Signup action allows a user to register a new account.
	 *
	 * @return array Data given
	 */
   function login() {
     return array('pseudo' => 'lol');
   }
 function detail() {
  }
  
 function create() {
  }
 function result_cr_event(){
	 $this->model->createevent();
 }
  /**
	 * The Signup action allows a user to register a new account.
	 *
	 * @return array Data given
	 */
  function signup() {

    $data = Request::getAssoc(array('pseudonyme', 'password', 'password_confirm', 'firstname', 'lastname', 'date_naissance', 'date_inscription', 'sex', 'email', 'telephone', 'access', 'adresse', 'code_postal', 'ville'));

    if (!in_array(null, $data, true)) {
      $errors = array();

      if($data['password'] == $data['password_confirm']) {
        $data['password'] = sha1($data['password']);
      }
    } else {
      include 'views/signup.php';
    }
  }
}

?>
