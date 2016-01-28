<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app 404.
 *
 * @package apps/404
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-21-12-2015
 */

class NotFoundView extends View {
  public function index() {
    $this->setTemplate('/apps/404/views/404.php');
  }
}

?>
