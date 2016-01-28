<?php
/**
 * Route.php
 */
defined('EUA_VERSION') or die('Access denied');

/**
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-10-11-2015
 */
class Route {
  /**
   * @var string Request string of the page
   */
  private static $query;

  /**
   * @var string URL Query String
   */
  private static $queryString;

  /**
   * @var array
   */
  private static $route;

  /**
   * Initializes Route.
   */
  public static function init() {
    self::$query = $_SERVER['REQUEST_URI'];

    // $_SERVER['REQUEST_URI'] contains the full URL of the page
    $dir = self::getDir();

    if ($dir != '/') {
      self::$query = str_replace($dir, '', $_SERVER['REQUEST_URI']);
    }

    // Cleansing
    self::$query = ltrim(self::$query, '/');
    self::$query = str_replace(array('index.php', 'index.html'), '', self::$query);

    // Extract query string
    $split_query = explode('?', self::$query);

    if (count($split_query) > 1) {
      self::$query = $split_query[0];
      self::$queryString = $split_query[1];
    }
  }

  /**
   * Launches the calculation of the current Route.
   *
   * @return array The route
   */
  public static function getRoute() {
    $route = self::$route;

    if (!empty($route)) {
      return $route;
    }

    $route = self::parseURL(self::$query);

    $clean_query = rtrim(self::$query, '/');

    self::$route = $route;

    return $route;
  }

  /**
   * Parses a URL to a route format.
   *
   * @param string $url A web page URL such as "news/see/13/"
   * @return array URL translated into a route ["app", "params", "admin"]
   */
  public static function parseURL($url) {
    $route = array(
      'app'    => '',
      'params' => array(),
      'admin'  => false
    );

    if (is_string($url)) {
      $url = trim($url, '/');

      if (!empty($url)) {
        $params = explode('/', $url);

        // Extract the app
        $app = array_shift($params);
        if (!empty($app)) {
          // Admin route
          if ($app == 'admin') {
            $route['admin'] = true;

            $app = array_shift($params);
            if (!empty($app)) {
              $route['app'] = $app;
            }
          } else {
            $route['app'] = $app;
          }
        }

        $route['params'] = $params;
      }
    }

    return $route;
  }

  /**
   * Returns the domain from which the user tried to acess the app.
   *
   * If the site is running on http://mysite.com/app/,
   * it should return "mysite.com".
   *
   * @return string Domain name
   */
  public static function getDomain() {
    return $_SERVER['HTTP_HOST'];
  }

  /**
   * Returns the full root location in which the app is installed, as defined in /system/config/config.php.
   *
   * If the website address is http://mysite.com/app/user/login,
   * it should return http://mysite.com/app/.
   *
   * @return string the full root location of the app
   */
  public static function getBase() {
    return rtrim(Config::get('config.base'), '/').'/';
  }

  /**
   * Returns the partial root directory.
   *
   * If the website address is "http://mysite.com/app/news/see/4?published=1",
   * it will return "/app/".
   *
   * @return string The partial root location
   */
  public static function getDir() {
    // Remove the working directory of the script
    // example: $_SERVER['SCRIPT_NAME'] = /app/index.php
    $dir = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);

    return $dir;
  }

  /**
   * Returns the query asked to the app in the URL.
   *
   * If the request URL is "http://mysite.com/app/news/see/4?published=1",
   * it will return "/news/see/4".
   *
   * @return string The partial root location of the app
   */
  public static function getQuery() {
    return self::$query;
  }

  /**
   * Returns the query string given in URL (without '?' char).
   *
   * If the request URL is "http://mysite.com/app/news/see/4?published=1",
   * it will return "published=1".
   *
   * @return string The partial root location of the app
   */
  public static function getQueryString() {
    return self::$queryString;
  }

  /**
   * Returns the full URL of the page.
   *
   * For example: "http://mysite.com/app/news/see/4?published=1"
   *
   * @return string The full URL
   */
  public static function getURL() {
    return self::getBase().self::$query.'?'.self::$queryString;
  }

  /**
   * Returns the referer (the previous address).
   *
   * @param bool $default true: if the referer is empty, returns the URL base; false: return ''
   * @return string The referer
   */
  public static function getReferer($default = true) {
    $base = self::getBase();

    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $base) !== false) {
      return $_SERVER['HTTP_REFERER'];
    } else if ($default) {
      return $base;
    }

    return '';
  }
}

?>
