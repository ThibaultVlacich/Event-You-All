<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the admin View for the app "board".
 *
 * @package apps/board/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-03-01-2016
 */

class BoardAdminView extends View {
  public function board() {
    $this->assign('css', Config::get('config.base').'/apps/board/admin/styles/board.css');

    $this->setTemplate('/apps/board/admin/views/board.php');
  }
}

?>
