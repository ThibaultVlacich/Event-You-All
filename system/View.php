<?php
/**
 * View.php
 */
defined('EUA_VERSION') or die('Access denied');
/**
 * View handles application's Views.
 *
 * @package System
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-03-12-2015
 */
class View {
  /**
   * @var string Template file to be used when the view will be rendered
   */
  private $templateFile = '';

  /**
   * @var array Global variables with a special treatment like "css" and "js"
   */
  private static $global_vars = array(
    'title'   => '',
    'css'     => array(),
    'js'      => array()
  );

  /**
   * Sets the file that will be used for template compiling
   *
   * @param string $file file that will be used for template compiling
   */
  public function setTemplate($file) {
    $file = str_replace(ROOT_PATH, '', $file);

    if (file_exists(ROOT_PATH.$file)) {
      $this->templateFile = $file;
    }
  }

  /**
   * Returns the template file configured for the current view
   *
   * @return string Template file href
   */
  public function getTemplate() {
    return $this->templateFile;
  }

  /**
   * Assigns a list of variables whose names are in $names to their $values
   *
   * @param mixed $names  variable names
   * @param mixed $values variable values
   */
  public function assign($name, $value) {
    if (!empty($name) && !empty($value)) {
      if($name == 'css' || $name == 'js') {
        self::$global_vars[$name][] = $value;
      } else {
        self::$global_vars[$name] = $value;
      }
    }
  }

  /**
   * Some variables may be considered as global vars in a way that they will have a
   * particular treatment when they will be assigned in the template compilator.
   * This treatment is defined in this function.
   * Global vars are not erased. If two different values are assigned to a same global var,
   * they will stack in an array.
   *
   * @param string $stack_name stack name
   * @return string variable value
   */
  public function getGlobalVar($stack_name) {
    if (empty(self::$global_vars[$stack_name])) {
      return '';
    }

    switch ($stack_name) {
      case 'css':
        $css = '';
        foreach (self::$global_vars['css'] as $file) {
          $css .= '<link href="'.$file.'" rel="stylesheet" type="text/css" />'."\n";
        }
        return $css;

      case 'js':
        $script = '';
        foreach (self::$global_vars['js'] as $file) {
          $script .= '<script type="text/javascript" src="'.$file.'"></script>'."\n";
        }
        return $script;

      default:
        return self::$global_vars[$stack_name];
    }
  }

  /**
   * Renders the view
   *
   * @param $module string Name of the module to render
   * @param $model array Calculated model of the app
   *
   * @return string The rendered string of the view
   */
  public function render($module = '', $model = array()) {
    // Execute the module method of the view, if it exists
    if (method_exists($this, $module)) {
      $this->$module();
    }

    // Check template file
    if (empty($this->templateFile)) {
      // A View cannot be empty
      return '';
    }

    ob_start();

    include_once ROOT_PATH.$this->templateFile;

    $this->rendered_string = ob_get_clean();

    return $this->rendered_string;
  }

  /**
   * Retrieves the last rendered view string
   */
  public function getRenderedString() {
    return $this->rendered_string;
  }
}
?>
