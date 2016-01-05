<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app contact.
 *
 * @package apps/faq
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-18-12-2015
 */

class ContactController extends Controller {

public function contact() {}
public function contactconfirm() {
	$data = Request::getAssoc(array('subject','message','firstname','lastname','email'));
}
	}





?>
