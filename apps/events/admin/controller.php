<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

class EventsAdminController extends Controller {
  var $default_module = 'index';
  var $access = array(
    'all' => 3
  );

  function index() {
    // Ici un tableau avec un listing de tous les événements disponibles sur le site
  }

  function modif() {

  }

  function delete() {

  }

}

?>
