<?php
/**
 * Request.php
 */
defined('EUA_VERSION') or die('Access denied');

/**
 * Request manages all input variables.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-01.12.2015
 */
class Request {
  /**
   * @var array Contains all checked variables to avoid infinite loop
   */
  private static $checked = array();

  /**
   * Returns the values of all variables with name in $names sent by $hash method
   *
   * You can use the following hashes:
   * - "GET"
   * - "POST"
   * - "FILES"
   * - "COOKIE"
   * - "REQUEST" (default)
   *
   * The following syntax is allowed:
   * <code>list($v1, ...) = Request::get(array('v1', 'v2'));</code>
   *
   * @param string|array  $names      variable names
   * @param mixed         $default    optional default values
   * @param string        $hash       name of the method used to send
   * @return mixed    array of values or the value
   */
  public static function get($names, $default = null, $hash = 'REQUEST') {
    // Data hash
    switch (strtoupper($hash)) {
      case 'GET':
        $data = &$_GET;
        break;

      case 'POST':
        $data = &$_POST;
        break;

      case 'FILES':
        $data = &$_FILES;
        break;

      case 'COOKIE':
        $data = &$_COOKIE;
        break;

      default:
        $data = &$_REQUEST;
        $hash = 'REQUEST';
        break;
    }

    if (is_array($names)) {
      // Going through the asked values in order to returns the array
      $result = array();

      foreach ($names as $name) {
        $value = self::getValue($data, $name, isset($default[$name]) ? $default[$name] : null, $hash);
        $result[] = $value;
        $result[$name] = $value;
      }

      return $result;
    } else {
      return self::getValue($data, $names, $default, $hash);
    }
  }

  /**
   * Returns an associative array of values in which keys are the $names
   *
   * @see Request::get()
   * @param array  $names   variable names
   * @param mixed  $default optional default values
   * @param string $hash    name of the method used to send
   * @return array array of values in which keys are the $names
   */
  public static function getAssoc(array $names, $default = null, $hash = 'REQUEST') {
    // Data hash
    switch (strtoupper($hash)) {
      case 'GET':
        $data = &$_GET;
        break;

      case 'POST':
        $data = &$_POST;
        break;

      case 'FILES':
        $data = &$_FILES;
        break;

      case 'COOKIE':
        $data = &$_COOKIE;
        break;

      default:
        $data = &$_REQUEST;
        $hash = 'REQUEST';
        break;
    }

    // Going through the asked values in order to returns the array
    $result = array();

    foreach ($names as $name) {
      $value = self::getValue($data, $name, isset($default[$name]) ? $default[$name] : null, $hash);
      $result[$name] = $value;
    }

    return $result;
  }

  /**
   * Returns the checked value associated to $name
   *
   * @param &array $data       request array
   * @param string $name       variable name
   * @param string $default    optional default value
   * @param string $hash       name of the method used to send
   * @return mixed the checked value associated to $name or null if not exists
   */
  public static function getValue(&$data, $name, $default, $hash) {
    if (isset(self::$checked[$hash.$name])) {
      // Directly get the verifed variable in data
      return $data[$name];
    } else {
      if (isset($data[$name]) && !is_null($data[$name])) {
        // Filter the variable value
        $data[$name] = self::filter($data[$name]);
      } else if (!is_null($default)) {
        // Use default
        $data[$name] = self::filter($default);
      }

      // Variable is verified
      if (isset($data[$name])) {
        self::$checked[$hash.$name] = true;
        return $data[$name];
      } else {
        return null;
      }
    }
  }

  /**
   * Returns the filtered variable after a tiny security check
   *
   * @param mixed $variable variable that we want to filter
   * @return mixed the filtered variable
   */
  public static function filter($variable) {
    if (is_array($variable)) {
      foreach ($variable as $key => $val) {
        $variable[$key] = self::filter($val);
      }
    } else {
      // Prevent XSS abuse
      $variable = preg_replace_callback('#</?([a-z]+)(\s.*)?/?>#', function($matches) {
        // Allowed tags
        if (in_array($matches[1], array(
          'b', 'strong', 'small', 'i', 'em', 'u', 's', 'sub', 'sup', 'a', 'button', 'img', 'br',
          'font', 'span', 'blockquote', 'q', 'abbr', 'address', 'code', 'hr',
          'audio', 'video', 'source', 'iframe',
          'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
          'ul', 'ol', 'li', 'dl', 'dt', 'dd',
          'div', 'p', 'var',
          'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td', 'colgroup', 'col',
          'section', 'article', 'aside'))) {
          return $matches[0];
        } else if (in_array($matches[1], array('script', 'link'))) {
          return '';
        } else {
          return htmlentities($matches[0]);
        }
      }, $variable);
    }

    return $variable;
  }

  /**
   * Retrieves the HTTP Method used by the client.
   *
   * @return string Either GET|POST|PUT|DEL...
   */
  public static function getMethod() {
    return $_SERVER['REQUEST_METHOD'];
  }
}
?>
