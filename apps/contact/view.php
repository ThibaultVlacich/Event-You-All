<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "Contact".
 *
 * @package apps/user
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-31-12-2015
 */

class ContactView extends View {

/*main page*/
  public function contact() {
    $this->assign('js', Config::get('config.base').'/apps/contact/scripts/contact.js');
    $this->assign('js', 'https://www.google.com/recaptcha/api.js');
    $this->assign('css', Config::get('config.base').'/apps/contact/styles/style.css');
    $this->setTemplate('/apps/contact/views/index.php');
    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
  }

/*confirm page*/
  public function contactconfirm () {
    $this->setTemplate('/apps/contact/views/contactconfirm.php');
  }
}

?>
