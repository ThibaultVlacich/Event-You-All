<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "events".
 *
 * @package apps/events
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 0.1.0-dev-11-12-2015
 */

class EventsController extends Controller {
  var $default_module = 'index';

  var $access = array(
    'create'         => 1,
    'create_confirm' => 1,
    'modif'          => 1,
    'modif_confirm'  => 1,
    'register'       => 1,
    'rate'           => 1
  );

  function index() {
    $data = $this->model->getEvents(0, 5, 'date_debut', true, 'WHERE `banniere` != "" AND `date_fin` > NOW()');

    $slideshow = array();

    foreach ($data as $event) {
      if (!empty($event['date_debut']) && $event['date_debut'] != '0000-00-00 00:00:00') {
        $date_debut_timestamp = strtotime($event['date_debut']);
        $event['date_debut'] = strftime('%d %b %Y', $date_debut_timestamp);
        $event['heure_debut'] = strftime('%H:%M', $date_debut_timestamp);
      } else {
        $event['date_debut'] = null;
        $event['heure_debut'] = null;
      }

      if (!empty($event['date_fin']) && $event['date_fin'] != '0000-00-00 00:00:00') {
        $date_fin_timestamp = strtotime($event['date_fin']);
        $event['date_fin'] = strftime('%d %b %Y', $date_fin_timestamp);
        $event['heure_fin'] = strftime('%H:%M', $date_fin_timestamp);
      } else {
        $event['date_fin'] = null;
        $event['heure_fin'] = null;
      }

      $slideshow[] = $event;
    }

    $data = $this->model->getEvents(0, 10, 'date_debut', true, 'WHERE `date_fin` > NOW()');

    $events = array();

    foreach ($data as $event) {
      if (!empty($event['date_debut']) && $event['date_debut'] != '0000-00-00 00:00:00') {
        $date_debut_timestamp = strtotime($event['date_debut']);
        $event['date_debut'] = strftime('%d %b %Y', $date_debut_timestamp);
        $event['heure_debut'] = strftime('%H:%M', $date_debut_timestamp);
      } else {
        $event['date_debut'] = null;
        $event['heure_debut'] = null;
      }

      if (!empty($event['date_fin']) && $event['date_fin'] != '0000-00-00 00:00:00') {
        $date_fin_timestamp = strtotime($event['date_fin']);
        $event['date_fin'] = strftime('%d %b %Y', $date_fin_timestamp);
        $event['heure_fin'] = strftime('%H:%M', $date_fin_timestamp);
      } else {
        $event['date_fin'] = null;
        $event['heure_fin'] = null;
      }

      $events[] = $event;
    }

    return array(
      'slideshow' => $slideshow,
      'events'    => $events,
      'regions'   => $this->model->getRegions(),
      'themes'    => $this->model->getThemes()
    );
  }

  function detail(array $params) {
    if (isset($params[0])) {
      $event_id = intval($params[0]);

      // Récupérer l'evenement lié depuis le model
      if (!($data = $this->model->getEvent($event_id))) {
        return array();
      }

      if (!empty($data['date_debut']) && $data['date_debut'] != '0000-00-00 00:00:00') {
        $date_debut_timestamp = strtotime($data['date_debut']);
        $data['date_debut'] = strftime('%a %d %b %Y', $date_debut_timestamp);
        $data['heure_debut'] = strftime('%H:%M', $date_debut_timestamp);
      } else {
        $data['date_debut'] = null;
        $data['heure_debut'] = null;
      }

      if (!empty($data['date_fin']) && $data['date_fin'] != '0000-00-00 00:00:00') {
        $date_fin_timestamp = strtotime($data['date_fin']);
        $data['date_fin'] = strftime('%a %d %b %Y', $date_fin_timestamp);
        $data['heure_fin'] = strftime('%H:%M', $date_fin_timestamp);
      } else {
        $data['date_fin'] = null;
        $data['heure_fin'] = null;
      }

      // Get linked articles
      $data['articles'] = $this->model->getArticlesForEvent($data['id']);
	    // Get creator's name and id
	    $data['creator'] = $this->model->getCreator($data['id_createur']);

      // Get number of participants
      $data['number_of_participants'] = $this->model->numberOfParticipants($event_id);

      // Get rate of event
      $data['rate'] = $this->model->getRateForEvent($event_id);

      // Get the user rate for the event
      $session = System::getSession();

      if ($session->isConnected()) {
        $data['user_rate'] = $this->model->getUserRateForEvent($event_id);
      }

      // See if the user is logged in, and if he's already registered to the event
      $session = System::getSession();

  	  if ($session->isConnected()) {
        $data['user_already_registered'] = $this->model->isCurrentUserRegisteredToEvent($event_id);
      }

      // Retourner les infos récupérées
      return $data;
    }
  }

  function create() {
    $data['themes']  = $this->model->getThemes();
    $data['types']   = $this->model->getTypes();
    $data['regions'] = $this->model->getRegions();

    return $data;
  }

  function create_confirm() {
    $data = Request::getAssoc(array('nom','date_de_j','date_de_m','date_de_a','time_de_h','time_de_m','date_fi_j','date_fi_m','date_fi_a','time_fi_h','time_fi_m','nbpl','price','reg','adr','code_p','ville','pays','descript','theme','type'));

    $errors = array();

    if (!in_array(null, $data, true)) {
      $data += Request::getAssoc(array('sujet','mclef','weborg','priv','partn'));

      $banner = Request::get('bann', null, 'FILES');

      $minwidth = 1600;
      $maxwidth = 3200;
      $minheight = 900;
      $maxheight = 1800;

      if(!empty($banner['name'])) {
        if(!$banner['error']) {
          $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
          //1. strrchr renvoie l'extension avec le point (« . »).
          //2. substr(chaine,1) ignore le premier caractère de chaine.
          //3. strtolower met l'extension en minuscules.
          $extension_upload = strtolower(substr(strrchr($banner['name'], '.'), 1));

          if ( in_array($extension_upload,$extensions_valides) ){
            $sizeimage = getimagesize($banner['tmp_name']);

            if ($sizeimage[0] >= $minwidth && $sizeimage[1] >= $minheight){
              if ($sizeimage[0] <= $maxwidth && $sizeimage[1] <= $maxheight) {
                $new_file_name = preg_replace('#[^a-z0-9]#', '', strtolower($data['nom'])).'-'.time().'.'.$extension_upload;

                move_uploaded_file($banner['tmp_name'], UPLOAD_DIR.'events'.DS.'banner'.DS.$new_file_name);

                $data['bann'] = Config::get('config.base').'/upload/events/banner/'.$new_file_name;
              } else {
                $errors += array('Problème de dimension pour la bannière : trop grand en hauteur et/ou en largeur');
              }
            } else {
              $errors += array('Problème de dimension pour la bannière : trop petit en hauteur et/ou en largeur');
            }
          } else {
            $errors += array('Problème d\'extension pour la bannière : votre fichier n\'est pas du type png, jpeg, jpg ou gif');
          }
        } else{
          $errors += array('Problème de Serveur');
        }
      }

      $poster = Request::get('poster', null, 'FILES');

      $minwidth = 90;
      $maxwidth = 450;
      $minheight = 160;
      $maxheight = 800;

      if(!empty($poster['name'])) {
        if(!$poster['error']) {
          $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

          //1. strrchr renvoie l'extension avec le point (« . »).
          //2. substr(chaine,1) ignore le premier caractère de chaine.
          //3. strtolower met l'extension en minuscules.
          $extension_upload = strtolower(substr(strrchr($poster['name'], '.'), 1));

          if (in_array($extension_upload,$extensions_valides)) {
            $sizeimage = getimagesize($poster['tmp_name']);

            if ($sizeimage[0] >= $minwidth && $sizeimage[1] >= $minheight) {
              if ($sizeimage[0] <= $maxwidth && $sizeimage[1] <= $maxheight) {
                $new_file_name = preg_replace('#[^a-z0-9]#', '', strtolower($data['nom'])).'-'.time().'.'.$extension_upload;

                move_uploaded_file($poster['tmp_name'], UPLOAD_DIR.'events'.DS.'poster'.DS.$new_file_name);

                $data['poster'] = Config::get('config.base').'/upload/events/poster/'.$new_file_name;
              } else {
                $errors += array('Problème de dimension pour le poster : trop grand en hauteur et/ou en largeur');
              }
            } else {
              $errors += array('Problème de dimension pour le poster : trop petit en hauteur et/ou en largeur');
            }
          } else {
            $errors += array('Problème d\'extension pour le poster : votre fichier n\'est pas du type png, jpeg, jpg ou gif');
          }
        } else{
          $errors += array('Problème de Serveur');
        }
      }

      $date_debut = $data['date_de_a'].'-'.$data['date_de_m'].'-'.$data['date_de_j'].' '.$data['time_de_h'].':'.$data['time_de_m'];
      $date_fin = $data['date_fi_a'].'-'.$data['date_fi_m'].'-'.$data['date_fi_j'].' '.$data['time_fi_h'].':'.$data['time_fi_m'];

      if (!empty($data['priv'])) {
        $data['priv'] = 1;
      } else {
         $data['priv'] = 0;
      }

	    if (empty($data['bann'])) {
        $data['bann'] = null;
      }

      if (empty($data['mclef'])) {
        $data['mclef'] = '';
      }

      $date_debut = $data['date_de_a'].'-'.$data['date_de_m'].'-'.$data['date_de_j'].' '.$data['time_de_h'].':'.$data['time_de_m'];
      $date_fin = $data['date_fi_a'].'-'.$data['date_fi_m'].'-'.$data['date_fi_j'].' '.$data['time_fi_h'].':'.$data['time_fi_m'];
      $data['date_de'] = $date_debut;
      $data['date_fi'] = $date_fin;
      $basicerrormessage = array('La date de fin se situe avant la date de début');
      if($data['date_de_a'] > $data['date_fi_a']){
        $errors += $basicerrormessage;
      }
      elseif($data['date_de_a'] == $data['date_fi_a']){
        if($data['date_de_m'] > $data['date_fi_m']){
          $errors += $basicerrormessage;
        }
        elseif($data['date_de_m'] == $data['date_fi_m']){
          if($data['date_de_j'] > $data['date_fi_j']){
            $errors += $basicerrormessage;
          }
          elseif($data['date_de_j'] == $data['date_fi_j']){
            if($data['time_de_h'] > $data['time_fi_h']){
              $errors += $basicerrormessage;
            }
            elseif($data['time_de_h'] == $data['time_de_h']){
              if($data['time_de_m'] > $data['time_fi_m']){
                $errors += $basicerrormessage;
              }
            }
          }
        }
      }

      if (empty($errors)) {
        $id_event = $this->model->createEvent($data);

  	    return array('id' => $id_event);
      }

	    return array('error' => $errors);
    }

    return array('error' => array('Tous les champs requis n\'ont pas été remplis.'));
  }

  function modif (array $params) {
    if (isset($params[0])) {
      $event_id = intval($params[0]);

      // Récupérer l'evenement lié depuis le model
      if (!($data = $this->model->getEvent($event_id))) {
        return array('errors' => array('L\'événement demandé n\'existe pas !'));
      }

      if(!($_SESSION['userid'] == $data['id_createur'])) {
        return array('errors' => array('Vous n\'êtes pas le créateur de cet événement !'));
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
      $data['sponsors'] = $this->model->getSponsors($event_id);

      return $data;
    } else {
      return array();
    }
  }

  function modif_confirm(array $params) {
    if (isset($params[0])) {
      $id_event = intval($params[0]);
      $data = Request::getAssoc(array('nom','date_de_j','date_de_m','date_de_a','time_de_h','time_de_m','date_fi_j','date_fi_m','date_fi_a','time_fi_h','time_fi_m','nbpl','price','reg','adr','code_p','ville','pays','descript','theme','type'));
      $errors = array();

      if (!in_array(null, $data, true)) {
        $data += Request::getAssoc(array('sujet','mclef','weborg','priv','partn'));

        $banner = Request::get('bann', null, 'FILES');

        $oldbannerposter=$this->model->getPosterBannerForEvent($id_event);

        $minwidth = 1600;
        $maxwidth = 3200;
        $minheight = 900;
        $maxheight = 1800;

        if(!empty($banner['name'])) {
          if(!$banner['error']) {
            $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
            //1. strrchr renvoie l'extension avec le point (« . »).
            //2. substr(chaine,1) ignore le premier caractère de chaine.
            //3. strtolower met l'extension en minuscules.
            $extension_upload = strtolower(substr(strrchr($banner['name'], '.'), 1));

            if ( in_array($extension_upload,$extensions_valides) ){
              $sizeimage=getimagesize($banner['tmp_name']);

              if ($sizeimage[0] >= $minwidth && $sizeimage[1] >= $minheight){
                if ($sizeimage[0] <= $maxwidth && $sizeimage[1] <= $maxheight) {
                  $new_file_name = preg_replace('#[^a-z0-9]#', '', strtolower($data['nom'])).'-'.time().'.'.$extension_upload;

                  move_uploaded_file($banner['tmp_name'], UPLOAD_DIR.'events'.DS.'banner'.DS.$new_file_name);

                  $data['bann'] = Config::get('config.base').'/upload/events/banner/'.$new_file_name;
                } else {
                  $errors += array('Problème de dimension pour la bannière : trop grand en hauteur et/ou en largeur');
                }
              } else {
                $errors += array('Problème de dimension pour la bannière : trop petit en hauteur et/ou en largeur');
              }
            } else {
              $errors += array('Problème d\'extension pour la bannière : votre fichier n\'est pas du type png, jpeg, jpg ou gif');
            }
          } else{
            $errors += array('Problème de Serveur');
          }
        } else { //prend ancienne banniere si aucune nouvelle entrée
          $data['bann'] = $oldbannerposter['banniere'];
        }

        $poster = Request::get('poster', null, 'FILES');

        $minwidth = 90;
        $maxwidth = 450;
        $minheight = 160;
        $maxheight = 800;

        if(!empty($poster['name'])) {
          if(!$poster['error']) {
            $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

            //1. strrchr renvoie l'extension avec le point (« . »).
            //2. substr(chaine,1) ignore le premier caractère de chaine.
            //3. strtolower met l'extension en minuscules.
            $extension_upload = strtolower(substr(strrchr($poster['name'], '.'), 1));

            if (in_array($extension_upload,$extensions_valides)) {
              $sizeimage = getimagesize($poster['tmp_name']);

              if ($sizeimage[0] >= $minwidth && $sizeimage[1] >= $minheight) {
                if ($sizeimage[0] <= $maxwidth && $sizeimage[1] <= $maxheight) {
                  $new_file_name = preg_replace('#[^a-z0-9]#', '', strtolower($data['nom'])).'-'.time().'.'.$extension_upload;

                  move_uploaded_file($poster['tmp_name'], UPLOAD_DIR.'events'.DS.'poster'.DS.$new_file_name);

                  $data['poster'] = Config::get('config.base').'/upload/events/poster/'.$new_file_name;
                } else {
                  $errors += array('Problème de dimension pour le poster : trop grand en hauteur et/ou en largeur');
                }
              } else {
                $errors += array('Problème de dimension pour le poster : trop petit en hauteur et/ou en largeur');
              }
            } else {
              $errors += array('Problème d\'extension pour le poster : votre fichier n\'est pas du type png, jpeg, jpg ou gif');
            }
          } else{
            $errors += array('Problème de Serveur');
          }
        } else { //prend ancien poster si aucun nouveau entré
            $data['poster'] = $oldbannerposter['poster'];
        }


        $date_debut = $data['date_de_a'].'-'.$data['date_de_m'].'-'.$data['date_de_j'].' '.$data['time_de_h'].':'.$data['time_de_m'];
        $date_fin = $data['date_fi_a'].'-'.$data['date_fi_m'].'-'.$data['date_fi_j'].' '.$data['time_fi_h'].':'.$data['time_fi_m'];
        $data['date_de']=$date_debut;
        $data['date_fi']=$date_fin;

        if (!empty($data['priv'])) {
          $data['priv'] = 1;
        }
        else{
           $data['priv'] = 0;
        }


        $data['date_de'] = $date_debut;
        $data['date_fi'] = $date_fin;
        $data['id'] = $id_event;
        $id_event = $this->model->modifEvent($data);

        $isValid = true;
        foreach($errors as $error){
          if(!empty($error)){
            $isValid = false;
          }
        }

        if($isValid === true) {
          $headers  = "From: " . strip_tags(Config::get('config.email')) . "\r\n";
          $headers .= "Reply-To: ". strip_tags(Config::get('config.email')) . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          $participants = $this->model->getParticipants($id_event);

          foreach($participants as $participant){
            $participant = $this->model->getUser($participant['id_utilisateur']);

            $message  = 'Bonjour <strong>'.$participant['nickname'].'</strong>,<br><br>' . "\r\n";
            $message .= 'L\'événement <a href="'.Config::get('config.base').'/events/detail/'.$data['id'].'">'.$data['nom'].'</a> auquel vous êtes inscrit sur <strong>Event-You-All</strong> a été modifié.<br><br>' . "\r\n";
            $message .= 'N\'hésitez pas à vous rendre sur le forum du site pour en savoir plus !';

            mail($participant['email'], 'Event-You-All : Modification d\'événement', $message, $headers);
          }
        }

  	    return array('id' => $id_event, 'error' => $errors);
      }
    }
  }

  public function register(array $params) {
    if(isset($params[0])) {
      $id_event = intval($params[0]);

      if(!($event = $this->model->getEvent($id_event))) {
        return false;
      }

      if ($this->model->isCurrentUserRegisteredToEvent($id_event)) {
        return array(
          'id_event'           => $id_event,
          'event'              => $event,
          'already_registered' => true,
          'success'            => false
        );
      }

      if(isset($params[1]) && $params[1] == 'confirm') {
        $this->model->registerUserToEvent($id_event);

        return array(
          'id_event' => $id_event,
          'event'    => $event,
          'success'  => true
        );
      }

      return array(
        'id_event' => $id_event,
        'event'    => $event,
        'success'  => false
      );
    }

    return false;
  }

  public function unregister(array $params) {
    if(isset($params[0])) {
      $id_event = intval($params[0]);

      if(!($event = $this->model->getEvent($id_event))) {
        return false;
      }

      if (!$this->model->isCurrentUserRegisteredToEvent($id_event)) {
        return array(
          'id_event'           => $id_event,
          'event'              => $event,
          'not_registered'     => true,
          'success'            => false
        );
      }

      if(isset($params[1]) && $params[1] == 'confirm') {
        $this->model->unregisterUserToEvent($id_event);

        return array(
          'id_event' => $id_event,
          'event'    => $event,
          'success'  => true
        );
      }

      return array(
        'id_event' => $id_event,
        'event'    => $event,
        'success'  => false
      );
    }

    return false;
  }

  function delete(array $params) {
    if (isset($params[0])) {
      $id_event = intval($params[0]);

      $data = $this->model->getEvent($id_event);

      $headers  = "From: " . strip_tags(Config::get('config.email')) . "\r\n";
      $headers .= "Reply-To: ". strip_tags(Config::get('config.email')) . "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $participants = $this->model->getParticipants($id_event);

      foreach($participants as $participant){
        $participant = $this->model->getUser($participant['id_utilisateur']);

        $message  = 'Bonjour <strong>'.$participant['nickname'].'</strong>,<br><br>' . "\r\n";
        $message .= 'L\'événement '.$data['nom'].' auquel vous étiez inscrit sur <strong>Event-You-All</strong> a été supprimé.<br><br>' . "\r\n";
        $message .= 'N\'hésitez pas à vous rendre sur le forum du site pour en savoir plus !';

        mail($participant['email'], 'Event-You-All : Suppression d\'événement', $message, $headers);
      }

      $this->model->deleteEvent($id_event);
    }
  }

  public function rate(array $params) {
    if(isset($params[0])) {
      $id_event = intval($params[0]);

      if(!($event = $this->model->getEvent($id_event))) {
        return false;
      }

      if ($this->model->getUserRateForEvent($id_event)) {
        return array(
          'id_event'           => $id_event,
          'event'              => $event,
          'already_rated'      => true,
          'success'            => false
        );
      }

      $note = Request::get('note', null, 'GET');

      if(isset($params[1]) && $params[1] == 'confirm') {
        $this->model->rateEvent($id_event, $note);

        return array(
          'id_event' => $id_event,
          'note'     => $note,
          'event'    => $event,
          'success'  => true
        );
      }

      return array(
        'id_event' => $id_event,
        'note'     => $note,
        'event'    => $event,
        'success'  => false
      );
    }

    return false;
  }

  public function contactorganisateur(array $params){
    if(isset($params[0])) {
      $id_event = intval($params[0]);
      $data = $this->model->getEvent($id_event);
    } else {
      return array('success' => false);
    }

    $message = Request::get('message');
    $sujet = Request::get('subject');

    $organisateur = $this->model->getUser($data['id_createur']);

    $session = System::getSession();
    if ($session->isConnected()) {
      $user_id = $_SESSION['userid'];
    }
    else{
      return array('data' => $data, 'not_register' => 'Vous n\'êtes pas connecté');
    }

    $mail_envoyeur = $this->model->getUser($user_id);

    $headers  = "From: " . strip_tags($mail_envoyeur['email']) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($mail_envoyeur['email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if(!empty($message) && !empty($sujet)){
      $html_message  = 'Bonjour <strong>'.$organisateur['nickname'].'</strong>,<br><br>' . "\r\n";
      $html_message .= 'Vous avez reçu un message au sujet de votre événement <a href="'.Config::get('config.base').'/events/detail/'.$data['id'].'">'.$data['nom'].'</a> sur <strong>Event-You-All</strong>.<br><br>' . "\r\n";
      $html_message .= $message;

      mail($organisateur['email'], $sujet, $html_message, $headers);

      return array('data' => $data, 'success' => true);
    } else {
      return array('data' => $data, 'success' => '');
    }
  }
}
?>
