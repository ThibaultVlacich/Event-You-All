<?php
/**
 * Event-You-All index.php start-up file
 *
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev
 */

/**
 * App version number
 */
define('EUA_VERSION', '0.1.0-dev');

/**
 * Error reporting level = MAXIMUM
 */
error_reporting(E_ALL);

/**
 * Files paths
 */
require_once 'paths.php';

/**
 * Core classes inclusion
 */
require_once SYS_DIR.'Main.php';

/**
 * Execute Main process
 */
$eua = new Main();

?>