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
    $advancedsearchsend=Request::getAssoc(array('advancedsearch','region','theme','date_event','organisateur',
    'prix_min','nbr_place_min','prix_max','nbr_place_max','city','zip_code','type','sponsor'));
    $data['theme'] = $this->model->gettheme();
    $data['type'] = $this->model->gettype();
    $data['region'] = $this->model->getregion();

    if(!empty($advancedsearchsend['sponsor'])){
      $advancedsearchsend['sponsor_evenement_id'] = $this->model->getEventwithSponsor($advancedsearchsend['sponsor']);
    }

    $advancedsearch = $advancedsearchsend;

    if(!empty($advancedsearchsend['organisateur'])){
      $advancedsearch['organisateur'] = $this->model->getUserID($advancedsearchsend['organisateur']);
    }

    if(isset($advancedsearchsend) && !empty($advancedsearchsend)){
      $advancedresults = $this->model->advancedsearchindatabase($advancedsearch);//function defined in model
      $data['advancedresults'] = $advancedresults;
      $k=0;
      foreach($data['advancedresults'] as $value){
        $data['advancedresults'][$k]['theme'] = $this->model->getthemewithid($value['id_theme']);
        $data['advancedresults'][$k]['type'] = $this->model->gettypewithid($value['id_type']);
        $k += 1;
      }
      return $data;
    }
    //Error if nothing has been selected by the user
    else{
      return array('error' => 'Veuillez remplir au minimum un champ avant de lancer la recherche');
    }
  }

  //In case of a simple research in the top search tool
  public function basicsearch() {
    $search=Request::getAssoc(array('search'));
    if(isset($search) && !empty($search)) {
        $results = $this->model->basicsearchindatabase($search);//Function defined in model
        $data['advancedresults'] = $results;
        $k=0;
        foreach($data['advancedresults'] as $value){
          $data['advancedresults'][$k]['theme'] = $this->model->getthemewithid($value['id_theme']);
          $data['advancedresults'][$k]['type'] = $this->model->gettypewithid($value['id_type']);
          $k += 1;
        }
        return $data;

}
    else {
      //Error if nothing has been typed in by the user
      return array("error" => "Veuillez insérer un mot-clef s'il vous plaît !");
    }
  }
}
?>
