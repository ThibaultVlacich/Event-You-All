<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "Search".
 *
 * @package apps/nameoftheapp
 * @author Hugo Michard <hugomichard@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

class SearchController extends Controller {
  // Optional
  var $search_module = 'search';

  // Method for the module
  public function search() {
    $data+=Request::getAssoc(array('advancedsearch','region','theme','date_event','organisateur',
    'prix_min','nbr_place_min','sponsors','prix_max','nbr_place_max','city','zip_code'))
    // Need to return an array of datas
    return array();
  }
}

?>
