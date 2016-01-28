<?php
/**
 * Event-You-All paths.php
 *
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0
 */

defined('EUA_VERSION') or die('Access denied');

/**
 * Directory Separator
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * Root directory
 */
define('ROOT_PATH', dirname(__FILE__).DS);

/**
 * System location
 */
define('SYS_DIR', ROOT_PATH.'system'.DS);

/**
 * Configs location
 */
define('CONFIG_DIR', ROOT_PATH.'system'.DS.'config'.DS);

/**
 * Libraries location
 */
define('LIBS_DIR', ROOT_PATH.'librairies'.DS);

/**
 * Applications location
 */
define('APPS_DIR', ROOT_PATH.'apps'.DS);

/**
 * Themes location
 */
define('TEMPLATES_DIR', ROOT_PATH.'templates'.DS);

/**
 * Upload directory location
 */
define('UPLOAD_DIR', ROOT_PATH.'upload'.DS);

?>
