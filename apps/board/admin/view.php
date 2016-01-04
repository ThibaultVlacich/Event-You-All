<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the admin View for the app "board".
 *
 * @package apps/board/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-03-01-2016
 */

class BoardAdminView extends View {
  public function board() {
    $this->setTemplate('/apps/board/admin/views/board.php');
  }
}

?>
