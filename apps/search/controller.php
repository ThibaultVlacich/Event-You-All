<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "Search".
 *
 * @package apps/search
 * @author Hugo Michard <hugomichard@isep.fr>
 * @version 1.1.0-dd-mm-yyyy
 */

class SearchController extends Controller {
  // Optional
  var $default_module = 'search';

  //In case of an advanced research
  public function advancedsearch() {
    $advancedsearchsend=Request::getAssoc(array('advancedsearch','region','theme','date_de_j','date_de_m','date_de_a','organisateur',
    'prix_min','nbr_place_min','prix_max','nbr_place_max','city','zip_code','type','sponsor'));
    $themetest = $this->model->gettheme();
    $typetest = $this->model->gettype();
    $regiontest = $this->model->getregion();
    foreach($regiontest as $index=>$value){
      if($value['afficher'] == 1){
        $data['region'][$index] = $value;
      }
    }
    foreach($typetest as $index=>$value){
      if($value['afficher'] == 1){
        $data['type'][$index] = $value;
      }
    }
    foreach($themetest as $index=>$value){
      if($value['afficher'] == 1){
        $data['theme'][$index] = $value;
      }
    }
    $isValid = false;
    if(isset($advancedsearchsend['date_de_j']) && empty($advancedsearchsend['date_de_j']) && isset($advancedsearchsend['date_de_m']) && !empty($advancedsearchsend['date_de_m']) && isset($advancedsearchsend['date_de_a']) && !empty($advancedsearchsend['date_de_a'])){
			$isValid = false;
		}
		if(isset($advancedsearchsend['date_de_j']) && !empty($advancedsearchsend['date_de_j']) && isset($advancedsearchsend['date_de_m']) && empty($advancedsearchsend['date_de_m']) && isset($advancedsearchsend['date_de_a']) && !empty($advancedsearchsend['date_de_a'])){
			$isValid = false;
		}
		if(isset($advancedsearchsend['date_de_j']) && !empty($advancedsearchsend['date_de_j']) && isset($advancedsearchsend['date_de_m']) && !empty($advancedsearchsend['date_de_m']) && isset($advancedsearchsend['date_de_a']) && empty($advancedsearchsend['date_de_a'])){
			$isValid = false;
		}
		if(isset($advancedsearchsend['date_de_j']) && !empty($advancedsearchsend['date_de_j']) && isset($advancedsearchsend['date_de_m']) && empty($advancedsearchsend['date_de_m']) && isset($advancedsearchsend['date_de_a']) && empty($advancedsearchsend['date_de_a'])){
			$isValid = false;
		}
		if(isset($advancedsearchsend['date_de_j']) && empty($advancedsearchsend['date_de_j']) && isset($advancedsearchsend['date_de_m']) && !empty($advancedsearchsend['date_de_m']) && isset($advancedsearchsend['date_de_a']) && empty($advancedsearchsend['date_de_a'])){
			$isValid = false;
		}
		if(isset($advancedsearchsend['date_de_j']) && empty($advancedsearchsend['date_de_j']) && isset($advancedsearchsend['date_de_m']) && empty($advancedsearchsend['date_de_m']) && isset($advancedsearchsend['date_de_a']) && !empty($advancedsearchsend['date_de_a'])){
			$isValid = false;
		}

		if(isset($advancedsearchsend['date_de_j']) && !empty($advancedsearchsend['date_de_j']) && isset($advancedsearchsend['date_de_m']) && !empty($advancedsearchsend['date_de_m']) && isset($advancedsearchsend['date_de_a']) && !empty($advancedsearchsend['date_de_a'])){
			$advancedsearchsend['date_event'] = $advancedsearchsend['date_de_a'].'-'.$advancedsearchsend['date_de_m'].'-'.$advancedsearchsend['date_de_j'];
			$isValid = true;
		}
    if($isValid === true){
      $datetest= $this->model->getIDeventforDate();
      $dateresults=array();
      foreach ($datetest as $index=>$value) {
        $datetranslation = date_create($value['date_debut']);
        $value['date_debut'] = date_format($datetranslation, 'Y-m-d');
        $advancedsearchsenddatecreate = date_create($advancedsearchsend['date_event']);
        $advancedsearchsenddatetranslation = date_format($advancedsearchsenddatecreate,'Y-m-d');
        if($value['date_debut'] == $advancedsearchsenddatetranslation){
          $dateresults[] = $value['id'];
        }
      }
      $advancedsearchsend['date_evenement_id'] = $dateresults;
    }


    if(!empty($advancedsearchsend['sponsor'])){
      $advancedsearchsend['sponsor_evenement_id'] = $this->model->getEventwithSponsor($advancedsearchsend['sponsor']);
    }
    if(!empty($advancedsearchsend['organisateur'])){
      $advancedsearchsend['organisateur'] = $this->model->getUserID($advancedsearchsend['organisateur']);
    }

    $advancedsearch = $advancedsearchsend;

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
        $themetest = $this->model->gettheme();
        $typetest = $this->model->gettype();
        $regiontest = $this->model->getregion();
        foreach($regiontest as $index=>$value){
          if($value['afficher'] == 1){
            $data['region'][$index] = $value;
          }
        }
        foreach($typetest as $index=>$value){
          if($value['afficher'] == 1){
            $data['type'][$index] = $value;
          }
        }
        foreach($themetest as $index=>$value){
          if($value['afficher'] == 1){
            $data['theme'][$index] = $value;
          }
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
