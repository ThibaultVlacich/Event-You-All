<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

class CguAdminController extends Controller {
  function default(){
    $data = $this->model->getCgu();
    return $data;
  }

  );




}

?>
