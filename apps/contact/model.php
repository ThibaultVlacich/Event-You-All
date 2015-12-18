<?php
/**
 * This is the Model for the app faq.
 *
 * @package apps/faq
 * @author Alexandre Gay <alexandre.gay@isep.fr>
 * @version 0.1.0-dev-18-12-2015
 */

defined('EUA_VERSION') or die('Access denied');

class ContactModel {

  /**
   * Checks whether a nickname is valid
   *
   * @param string $nickname
   * @return mixed true if valid or error string
   */
  public function checkLastName($lastname) {
    if (empty($lastname) || strlen($lastname) < 1 || strlen($lastname) > 40) {
      return 'Le nom n\'est pas assez long.';
    } else if (!Tools::isEmail($lastname) && preg_match('#[\.]+#', $lastInsertIdname)) {
      return 'Le nom contient des caractères incorrects.';
    }
  }

  public function checkFirstName($firstname) {
    if (empty($firstname) || strlen($firstname) < 1 || strlen($firstname) > 40) {
      return 'Le prénom n\'est pas assez long.';
    } else if (!Tools::isEmail($firstname) && preg_match('#[\.]+#', $firstInsertIdname)) {
      return 'Le prénom contient des caractères incorrects.';
    }
  }

  public function checkSubject($subject) {
    if (empty($subject) || strlen($subject) < 2 ) {
      return 'Le sujet n\'est pas assez long.';
    } else if (strlen($subject) > 200) {
      return 'Le sujet est trop long.';
    }
    }

    public function checkMessage($message) {
      if (empty($message) || strlen($message) < 2 ) {
        return 'Le sujet n\'est pas assez long.';
      } else if (strlen($message) > 2000) {
        return 'Le message est trop long.';
      }
  }

  /**
   * Checks whether an email is valid and available
   *
   * @param string $email
   * @return mixed true if valid or error string
   */
  public function checkEmail($email) {
    if (!Tools::isEmail($email)) {
      return 'L\'email saisi est invalide.';
    }
  }



}

?>
