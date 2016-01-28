<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "user".
 *
 * @package apps/user/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-12-01-2016
 */

class UserAdminController extends Controller {
  var $default_module = 'index';
  var $access = array(
    'all' => 3
  );

  public function index(array $params) {
    $n = 50; // Number of topics per page
    $page = 1; // Current page

    // Get the current page from URL
    if ((isset($params[0]) && $params[0] == 'page') && isset($params[1])) {
      $page = intval($params[1]);
    }

    $users = $this->model->getUsers(($page-1)*$n, $n);

    return array(
      'users'        => $users,
      'total'        => $this->model->countUsers(),
      'current_page' => $page,
      'per_page'     => $n
    );
  }

  public function modify(array $params) {
    if(isset($params[0])) {
      $id_user = intval($params[0]);

      if(!($user = $this->model->getUser($id_user))) {
        return false;
      }

      $data = Request::getAssoc(array());

      $errors = array();

      if (Request::getMethod() == 'POST') {
        $data = Request::getAssoc(array('access', 'lastname', 'firstname', 'lastname', 'email'));

        if(!Tools::isEmail($data['email'])) {
          $errors[] = 'L\'email saisi n\'est pas valide !';
        }

        if (empty($errors)) {
          $this->model->updateUser($id_user, $data);
        }

        $password = Request::getAssoc(array('password', 'password_confirm'));

        if(!empty($password['password']) && !empty($password['password_confirm'])) {
          // Update the password only if modified
          if ($password['password'] == $password['password_confirm']) {
            $this->model->updateUserPassword($id_user, $password['password']);
          } else {
            $errors[] = 'Les mots de passe saisis ne sont pas identiques.';
          }
        }

        return array(
          'id_user' => $id_user,
          'user'    => $user,
          'method'  => 'POST',
          'errors'  => $errors
        );
      }

      return array(
        'id_user' => $id_user,
        'user'    => $user,
        'method'  => 'GET',
        'errors'  => $errors
      );
    }

    return false;
  }

  public function delete(array $params) {
    if(isset($params[0])) {
      $id_user = intval($params[0]);

      if(!($user = $this->model->getUser($id_user))) {
        return false;
      }

      if(isset($params[1]) && $params[1] == 'confirm') {
        $this->model->deleteUser($id_user);

        return array(
          'id_user'  => $id_user,
          'user'     => $user,
          'success'  => true
        );
      }

      return array(
        'id_user'  => $id_user,
        'user'     => $user,
        'success'  => false
      );
    }

    return false;
  }

}

?>
