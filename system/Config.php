<?php
/**
 * Config.php
 */
defined('EUA_VERSION') or die('Access denied');

/**
 * Config loads all configuration files, manages all configuration values.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-02-12-2015
 */
class Config {
  /**
   * @var array Multidimensionnal array containing configurations sorted by type
   *
   * No '.' in keys because it's a reserved character
   */
  private static $configs = array();

  /**
   * @var array List of loaded configuration files
   */
  private static $files = array();

  /**
   * Returns a configuration value.
   *
   * @param  string $path     configuration path
   * @param  mixed  $default  optional default value
   * @return mixed  configuration value related to $path
   */
  public static function get($path, $default = null) {
    $result = $default;

    // Config nodes path
    if ($nodes = explode('.', $path)) {
      $config = &self::$configs;
      $path_count = count($nodes) - 1;

      // Running through configs
      for ($i = 0; $i < $path_count; $i++) {
        if (isset($config[$nodes[$i]])) {
          $config = &$config[$nodes[$i]];
        } else {
          break;
        }
      }

      if (isset($config[$nodes[$i]])) {
        $result = $config[$nodes[$i]];
      }
    }

    return $result;
  }

  /**
   * Loads configuration's values from a file.
   *
   * @param  string  $field configuration name
   * @param  string  $file  configuration file
   * @param  string  $type  file type
   * @return boolean true if successful, false otherwise
   */
  public static function load($field, $file, $type = '') {
    if (!is_file($file) || isset(self::$files[$field]) || strpos($field, '.') !== false) {
      return false;
    }

    // Find type using file extension
    if (empty($type)) {
      $type = substr($file, strrpos($file, '.') + 1);
    }

    switch(strtolower($type)) {
      case 'ini':
        self::$configs[$field] = parse_ini_file($file, true);
        break;
      case 'php':
        include_once $file;

        if (isset(${$field})) {
          self::$configs[$field] = ${$field};
        }

        unset(${$field});

        break;
      case 'xml':
        self::$configs[$field] = simplexml_load_file($file);
        break;
      case 'json':
        self::$configs[$field] = json_decode(file_get_contents($file), true);
        break;
      default:
        return false;
    }

    // Saving the file
    self::$files[$field] = array($file, $type);

    return true;
  }

  /**
   * Unloads a configuration.
   *
   * @param string $field Configuration's name
   */
  public static function unload($field) {
    unset(self::$configs[$field], self::$files[$field]);
  }
}
?>
