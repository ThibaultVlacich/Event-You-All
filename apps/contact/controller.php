<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app contact.
 *
 * @package apps/faq
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 1.1.0-18-12-2015
 */

class ContactController extends Controller {
  var $default_module = 'contact';

  public function contact() {}

  public function contactconfirm() {
    $data = Request::getAssoc(array('subject','message','firstname','lastname','email'));

    //Destination
    $mail = Config::get('config.email');

    //filter
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
    {
      $passage_ligne = "\r\n";
    }
    else
    {
      $passage_ligne = "\n";
    }

    //extract email
    $email = $data['email'];
    //extract firsname
    $firstname = $data['firstname'];
    //extract lastname
    $lastname = $data['lastname'];
    //extract message text
    $message_txt = $data['message'];
    //extract subject.
    $subject = $data['subject'];

    //Create boundary
    $boundary = "-----=".md5(rand());

    //=====Create header
    $header = "From:  <".$email.">".$passage_ligne;
    $header.= "Reply-to:  <".$mail.">".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========

    //=====Create message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Message
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;

    //$message.= $passage_ligne."--".$boundary.$passage_ligne;

    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;


    //=====send e-mail
    mail($mail,$subject,$message,$header);
    //==========
  }
}
?>
