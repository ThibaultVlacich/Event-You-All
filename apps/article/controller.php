<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "article".
 *
 * @package apps/article
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 1.1.0-12-12-2015
 */

class ArticleController extends Controller {
  var $default_module = 'all';

  var $access = array(
    'create'         => 1,
    'create_confirm' => 1
  );

  function detail(array $params) {
    if (isset($params[0])) {
      $article_id = intval($params[0]);

      // Récupérer l'article lié depuis le model
      $data = $this->model->getArticle($article_id);
      // Get creator's name and id
      $data['creator'] = $this->model->getCreatorForArticle($data['id_createur']);
      // Get vip of event
      if (!empty($data['id_evenement'])){
        $data['vip'] = $this->model->getVip($data['id_evenement']);
      }

      // Retourner les infos récupérées
      return $data;
    }
  }

  function create() {
    //recupere id utilisateur
    $session = System::getSession();
    if ($session->isConnected()) {
      $user_id = $_SESSION['userid'];
    }

    //recupere infos sur evenements crees par utilisateur
    $data['evenements'] = $this->model->getUserEvents($user_id);

    return $data;
  }

  function create_confirm() {
    $data = Request::getAssoc(array('nom','corps','arti'));

    if (!in_array(null, $data, true)) {
      $data += Request::getAssoc(array('mclef'));
      $errors = array();

      //TO DO : Make the error work (doesn't appear despite bad extension)
      //-------------Banniere---------------------------------------------------
      $maxwidth = 3200;
      $minwidth = 1600;
      $maxheight = 1800;
      $minheight = 900;
      $banner = Request::get('bann', null, 'FILES');
      $message_erreur = '';
      if(!empty($banner['name'])) {
        if(!$banner['error']) {
            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            //1. strrchr renvoie l'extension avec le point (« . »).
            //2. substr(chaine,1) ignore le premier caractère de chaine.
            //3. strtolower met l'extension en minuscules.
            $extension_upload = strtolower(  substr(  strrchr($banner['name'], '.')  ,1)  );
            if ( in_array($extension_upload,$extensions_valides) ){
                $sizeimage=getimagesize($banner['tmp_name']);
                if ($sizeimage[0] > $minwidth and $sizeimage[1] > $minheight){
                    $new_file_name = $banner['name'];

                    move_uploaded_file($banner['tmp_name'], UPLOAD_DIR.'article'.DS.'banner'.DS.$new_file_name);

                    $data['bann'] = Config::get('config.base').'/upload/article/banner/'.$new_file_name;
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
      //----------------------------------------------------------------------------(fin banniere)

      if (empty($data['bann'])) {
        $data['bann'] = null;
      }

      $id_article = $this->model->createEvent($data);

      return array('id' => $id_article,'error' => $errors);
    }
  }

  function modif(array $params) {
    if (isset($params[0])) {
      $article_id = intval($params[0]);

      // Récupérer l'evenement lié depuis le model
      if (!($data = $this->model->getArticle($article_id))) {
        return array();
      }

      // Get creator's name and id
      $data['creator'] = $this->model->getCreatorForArticle($data['id']);

      //recupere id utilisateur
      $session = System::getSession();

      if ($session->isConnected()) {
        $user_id = $_SESSION['userid'];
      }

      //recupere infos sur evenements crees par utilisateur
      $data['evenements'] = $this->model->getUserEvents($user_id);

      return $data;
    } else {
      return false;
    }
  }

  function modif_confirm(array $params) {
    if (isset($params[0])) {
      $article_id = intval($params[0]);

      $data = Request::getAssoc(array('nom','corps'));

      if (!in_array(null, $data, true)) {
        $data += Request::getAssoc(array('mclef'));
        $errors = array();

        //TO DO : Make the error work (doesn't appear despite bad extension)
        //-------------Banniere---------------------------------------------------
        $maxwidth = 100000;
        $minwidth = 0;
        $maxheight = 100000;
        $minheight = 0;
        $banner = Request::get('bann', null, 'FILES');
        $message_erreur = '';

        if(!empty($banner['name'])) {
          if(!$banner['error']) {
              $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
              //1. strrchr renvoie l'extension avec le point (« . »).
              //2. substr(chaine,1) ignore le premier caractère de chaine.
              //3. strtolower met l'extension en minuscules.
              $extension_upload = strtolower(  substr(  strrchr($banner['name'], '.')  ,1)  );
              if ( in_array($extension_upload,$extensions_valides) ){
                  $sizeimage=getimagesize($banner['tmp_name']);
                  if ($sizeimage[0] > $minwidth and $sizeimage[1] > $minheight){
                      $new_file_name = $banner['name'];

                      move_uploaded_file($banner['tmp_name'], UPLOAD_DIR.'article'.DS.'banner'.DS.$new_file_name);

                      $data['bann'] = Config::get('config.base').'/upload/article/banner/'.$new_file_name;
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
        else{
            $data['bann'] = '';
        }
        //----------------------------------------------------------------------------(fin banniere)

        if (empty($data['bann'])) {
          $data['bann'] = null;
        }

        $this->model->modifArticle($data,$article_id);

        return array('id' => $article_id, 'error' => $errors);
      }
    }
  }

  function deleted(array $params) {
    if (isset($params[0])) {
      
      $id_event = intval($params[0]);
      $articles = $this->model->getArticle($id_event);
      $session = System::getSession();
      $user_id   = $_SESSION['userid'];
      if ($articles['id_createur']==$user_id){
      
      $this->model->deleteArticle($id_event);
      return 1;
    }
    else{
        return 0;
    }
    }
  }

  function all(array $params) {
    $n = 10; // Number of topics per page
    $page = 1; // Current page

    // Get the current page from URL
    if ((isset($params[0]) && $params[0] == 'page') && isset($params[1])) {
      $page = intval($params[1]);
    }

    $articles = $this->model->getArticles(($page-1)*$n, $n);

    return array(
      'articles'     => $articles,
      'total'        => $this->model->countArticles(),
      'current_page' => $page,
      'per_page'     => $n
    );
  }
}
?>
