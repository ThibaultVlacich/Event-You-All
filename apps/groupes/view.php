<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "groupes".
 *
 * @package apps/groupes
 * @author Alexis Dahan <alexis.dahan@isep.fr>
 * @version 0.1.0-dev-17-12-2015
 */

class GroupesView extends View {
  function __construct() {
    // Here assign CSSs/JSs for all the app
    // EX : $this->assign('css', Config::get('config.base').'/apps/user/styles/style.css');
  }

  // Method for the module
  public function groupe() {
    // Here assign CSSs/JSs for that method
    $this->assign('css', Config::get('config.base').'/apps/groupes/styles/groupe.css');

    // The assign the view for the module
    $this->setTemplate('/apps/groupes/views/groupe.php');
  }
}

?>
