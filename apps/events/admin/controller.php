<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-13-12-2015
 */

class EventsAdminController extends Controller {
  var $default_module = 'index';
  var $access = array(
    'all' => 3
  );

  public function index(array $params) {
    $n    = 50; // Number of events per page
    $page = 1; // Current page

    // Get the current page from URL
    if ((isset($params[0]) && $params[0] == 'page') && isset($params[1])) {
      $page = intval($params[1]);
    }

    $events = $this->model->getAllEvents(($page-1)*$n, $n);

    return array(
      'events'       => $events,
      'total'        => $this->model->countEvents(),
      'current_page' => $page,
      'per_page'     => $n
    );
  }

  function modif(array $params) {
    if (isset($params[0])) {
      $event_id = intval($params[0]);

      // Récupérer l'evenement lié depuis le model
      if (!($data = $this->model->getEvent($event_id))) {
        return array();
      }

      if (!empty($data['date_debut']) && $data['date_debut'] != '0000-00-00 00:00:00') {
        $data['date_debut_timestamp'] = strtotime($data['date_debut']);
      }

      if (!empty($data['date_fin']) && $data['date_fin'] != '0000-00-00 00:00:00') {
        $data['date_fin_timestamp'] = strtotime($data['date_fin']);
      }

      // Get creator's name and id
      $data['creator'] = $this->model->getCreator($data['id']);

      // Retourner les infos récupérées
      $data['themes'] = $this->model->getThemes();
      $data['types'] = $this->model->getTypes();
      $data['regions'] = $this->model->getRegions();

      return $data;
    } else {
      return array();
    }
  }

  function modiftheme (array $params) {
    if (isset($params[0])) {
      $theme_id = intval($params[0]);

      // Récupérer le theme lié depuis le model
      if (!($data = $this->model->getTheme($theme_id))) {
        return array();
      } else {
        return $data;
      }
    }
  }

  function modiftype (array $params) {
    if (isset($params[0])) {
      $theme_id = intval($params[0]);

      if (!($data = $this->model->getType($theme_id))) {
        return array();
      } else {
        return $data;
      }
    }
  }

  function modifregion (array $params) {
    if (isset($params[0])) {
      $theme_id = intval($params[0]);

      if (!($data = $this->model->getRegion($theme_id))) {
        return array();
      } else {
        return $data;
      }
    }
  }

  function modif_confirm(array $params) {
    if (isset($params[0])) {
    $id_event = intval($params[0]);
    $data = Request::getAssoc(array('nom','date_de_j','date_de_m','date_de_a','time_de_h','time_de_m','date_fi_j','date_fi_m','date_fi_a','time_fi_h','time_fi_m','nbpl','price','reg','adr','code_p','ville','pays','descript','theme','type'));
    $errors = array();

    if (!in_array(null, $data, true)) {
      $data += Request::getAssoc(array('sujet','mclef','weborg','priv'));

      $maxwidth = 100000;
      $minwidth = 0;
      $maxheight = 100000;
      $minheight = 0;

      $banner = Request::get('bann', null, 'FILES');

      $message_erreur = '';

      $oldbannerposter=$this->model->getPosterBannerForEvent($id_event);

      if(!empty($banner['name'])) {
        if(!$banner['error']) {
          $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
          $extension_upload = strtolower(  substr(  strrchr($banner['name'], '.')  ,1)  );

          if ( in_array($extension_upload,$extensions_valides) ){
            $sizeimage = getimagesize($banner['tmp_name']);

            if ($sizeimage[0] > $minwidth and $sizeimage[1] > $minheight){
              $new_file_name = $banner['name'];

              move_uploaded_file($banner['tmp_name'], UPLOAD_DIR.'events'.DS.'banner'.DS.$new_file_name);

              $data['bann'] = Config::get('config.base').'/upload/events/banner/'.$new_file_name;
            } else {
              $errors += array('Problème de dimension pour la bannière : trop petit en hauteur et/ou en largeur');
            }
          } else {
            $errors += array('Problème d\'extension pour la bannière : votre fichier n\'est pas du type png, jpeg, jpg ou gif');
          }
        } else{
          $errors += array('Problème de Serveur');
        }
      } else {
        //prend ancienne banniere si aucune nouvelle entrée
        $data['bann'] =$oldbannerposter['banniere'];
      }

      $poster = Request::get('poster', null, 'FILES');

      if(!empty($poster['name'])) {
        if(!$poster['error']) {
            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $extension_upload = strtolower(  substr(  strrchr($poster['name'], '.')  ,1)  );

            if ( in_array($extension_upload,$extensions_valides) ){
                $sizeimage = getimagesize($poster['tmp_name']);

                if ($sizeimage[0] > $minwidth and $sizeimage[1] > $minheight){
                  $new_file_name = $poster['name'];

                  move_uploaded_file($poster['tmp_name'], UPLOAD_DIR.'events'.DS.'poster'.DS.$new_file_name);

                  $data['poster'] = Config::get('config.base').'/upload/events/poster/'.$new_file_name;
                } else {
                  $errors += array('Problème de dimension pour le poster : trop petit en hauteur et/ou en largeur');
                }
            } else {
             $errors += array('Problème d\'extension pour le poster : votre fichier n\'est pas du type png, jpeg, jpg ou gif');
            }
          } else {
            $errors += array('Problème de Serveur');
          }
        } else {
          //prend ancien poster si aucun nouveau entré
          $data['poster'] =$oldbannerposter['poster'];
        }

        $date_debut = $data['date_de_a'].'-'.$data['date_de_m'].'-'.$data['date_de_j'].' '.$data['time_de_h'].':'.$data['time_de_m'];
        $date_fin = $data['date_fi_a'].'-'.$data['date_fi_m'].'-'.$data['date_fi_j'].' '.$data['time_fi_h'].':'.$data['time_fi_m'];
        $data['date_de'] = $date_debut;
        $data['date_fi'] = $date_fin;

        if (!empty($data['priv'])) {
          $data['priv'] = 1;
        } else {
           $data['priv'] = 0;
        }

        $data['date_de'] = $date_debut;
        $data['date_fi'] = $date_fin;
        $data['id'] = $id_event;
        $id_event = $this->model->modifEvent($data,1);

        return array('id' => $id_event, 'error' => $errors);
      }
    }
  }

  function delete(array $params) {
    if (isset($params[0])) {
      $id_event = intval($params[0]);
      $delete = $this->model->deleteEvent($id_event);

      header('Location: '.Config::get('config.base').'/admin/events');
    }

  }

  //-----------------------THEME----------------------------------
  function hidetheme(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);
      $this->model->nodisplayTheme($id_theme);

      header('Location: '.Config::get('config.base').'/admin/events/themes');
    }
  }

  function showtheme(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);
      $this->model->displayTheme($id_theme);

      header('Location: '.Config::get('config.base').'/admin/events/themes');
    }
  }

  function modif_confirm_theme(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);

      $data = Request::getAssoc(array('nom'));
      $this->model->modTheme($id_theme,$data['nom']);

      header('Location: '.Config::get('config.base').'/admin/events/themes');
    }
  }

  function add_confirm_theme(array $params) {
      $data = Request::getAssoc(array('nom'));
      $this->model->addTheme($data);

      header('Location: '.Config::get('config.base').'/admin/events/themes');
  }

  public function themes(array $params) {
    $themes = $this->model->getAllThemes();

    return $themes;
  }

  public function addtheme(array $params) {


  }

  //-----------TYPE---------------------------------------------
  function hidetype(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);
      $this->model->nodisplayType($id_theme);

      header('Location: '.Config::get('config.base').'/admin/events/types');
    }

  }

  function showtype(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);
      $this->model->displayType($id_theme);

      header('Location: '.Config::get('config.base').'/admin/events/types');
    }
  }

  function modif_confirm_type(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);
      $data = Request::getAssoc(array('nom'));
      $this->model->modType($id_theme,$data['nom']);

      header('Location: '.Config::get('config.base').'/admin/events/types');
    }
  }

  function add_confirm_type(array $params) {
      $data = Request::getAssoc(array('nom'));
      $this->model->addType($data);

      header('Location: '.Config::get('config.base').'/admin/events/types');
  }

  public function types(array $params) {
    $themes = $this->model->getAllTypes();

    return $themes;
  }

  public function addtype(array $params) {


  }

  //---------------REGIONS--------------------------
  function hideregion(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);
      $this->model->nodisplayRegion($id_theme);

      header('Location: '.Config::get('config.base').'/admin/events/regions');
    }

  }

  function showregion(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);
      $this->model->displayRegion($id_theme);

      header('Location: '.Config::get('config.base').'/admin/events/regions');
    }

  }

  function modif_confirm_region(array $params) {
    if (isset($params[0])) {
      $id_theme = intval($params[0]);

      $data = Request::getAssoc(array('nom'));
      $this->model->modRegion($id_theme,$data['nom']);

      header('Location: '.Config::get('config.base').'/admin/events/regions');
    }
  }

  function add_confirm_region(array $params) {
      $data = Request::getAssoc(array('nom'));
      $this->model->addRegion($data);

      header('Location: '.Config::get('config.base').'/admin/events/regions');
  }

  public function regions(array $params) {
    $themes = $this->model->getAllRegions();
    return $themes;
  }

  public function addregion(array $params) {


  }
}

?>
