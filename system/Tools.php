<?php
/**
 * Tools.php
 */
defined('EUA_VERSION') or die('Access denied');

/**
 * Tools contains some tiny helpful functions.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-03-12-2015
 */
class Tools {
  /**
   * Removes accents from a string.
   *
   * @param string $string
   * @return string
   */
  public static function stripAccents($string) {
    return strtr(
      utf8_decode($string),
      utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'),
      'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'
    );
  }

  /**
   * Verifies whether a string is a valid email.
   *
   * @param string $string
   * @return bool
   */
  public static function isEmail($string) {
    return (!empty($string) && preg_match('#^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$#i', $string));
  }

  /**
   * Verifies whether a string is a valid website.
   *
   * @param string $string
   * @return bool
   */
  public static function isWebsite($string) {
    return (!empty($string) && preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $string));
  }
}
?>
