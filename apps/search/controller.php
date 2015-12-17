<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "Search".
 *
 * @package apps/search
 * @author Hugo Michard <hugomichard@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

class SearchController extends Controller {
  // Optional
  var $search_module = 'search';

  //In case of an advanced research
  public function searchavance() {
    $data+=Request::getAssoc(array('advancedsearch','region','theme','date_event','organisateur',
    'prix_min','nbr_place_min','sponsors','prix_max','nbr_place_max','city','zip_code'));
    // Need to return an array of datas
    return array();
  }

  //In case of a simple research in the top search tool
  public function basicsearch() {
    $search=Request::getAssoc(array('search'));
    if(isset($search) && !empty($search)) {
        $results = $this->model->basicsearchindatabase($search);//Function defined in model
        return $results;
        
}
    else {
      //Error if nothing has been typed in by the user
      return array('error' => "Veuillez insérer un mot-clef s'il vous plaît !")}
    return array();
  }
}
?>
