<?php
/**
 * Event-You-All index.php start-up file
 *
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0
 */

/**
 * App version number
 */
define('EUA_VERSION', '1.1.0');

/**
 * Error reporting level = MAXIMUM
 */
error_reporting(E_ALL);

/**
 * Set locale to fr_FR
 */
setlocale(LC_ALL, 'fr_FR.UTF-8');

/**
 * Files paths
 */
require_once 'paths.php';

/**
 * Core classes inclusion
 */
require_once SYS_DIR.'System.php';
require_once SYS_DIR.'Route.php';
require_once SYS_DIR.'Config.php';
require_once SYS_DIR.'Request.php';
require_once SYS_DIR.'Tools.php';
require_once SYS_DIR.'Main.php';

/**
 * Execute Main process
 */
$eua = new Main();

?>
