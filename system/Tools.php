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
 * @version 0.1.0-dev-03-12-2015
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
	 * Transforms a string into HTTP request
	 *
	 * @param string $url
	 * @return string starting with http://
	 */
	public static function secureURL($url) {
		if (!empty($url) && strpos($url, 'http') === false) {
			return 'http://'.$url;
		}

		return $url;
	}

	/**
	 * Move elements in array
	 *
	 * @param array $array Array to reorder (reference)
	 * @param int $a From position
	 * @param int $b To new position
	 */
	public static function moveElementInArray(&$array, $a, $b) {
		$out = array_splice($array, $a, 1);
		array_splice($array, $b, 0, $out);
	}
}
?>
