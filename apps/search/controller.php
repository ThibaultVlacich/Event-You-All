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
  var $default_module = 'search';

  //In case of an advanced research
  public function advancedsearch() {
    $advancedsearch=Request::getAssoc(array('advancedsearch','region','theme','date_event','organisateur',
    'prix_min','nbr_place_min','sponsors','prix_max','nbr_place_max','city','zip_code','type'));
    if(isset($advancedsearch) && !empty($advancedsearch)){
      $advancedresults = $this->model->advancedsearchindatabase($advancedsearch);//function defined in model
      return $advancedresults;
    }

    //Error if nothing has been selected by the user
    else{
      return array('error' => 'Veuillez remplir au minimum un champ avant de lancer la recherche');
    }

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
      return array("error" => "Veuillez insérer un mot-clef s'il vous plaît !");
    }
    return array();
  }
}
?>
