<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

class ArticleAdminController extends Controller {
  var $default_module = 'index';
  var $access = array(
    'all' => 3
  );

  function index() {
    // Ici un tableau avec un listing de tous les événements disponibles sur le site
    $data = Request::getAssoc(array('number', 'times'), null, 'GET');
    if ( isset($data['number']) and !empty($data['number']))
    {
        if ( isset($data['times']) and !empty($data['times']))
        {
            if  ($data['times']>100)
            {
                $data['events']=$this->model->getAllArticles(0,intval($data['times']));
            }
            else
            {
                $calc=intval($data['times'])*(intval($data['number'])-1);
                $data['events']=$this->model->getAllArticles($calc,intval($data['times']));
            }
        }
        else
        {
            $calc=10*intval($data['number']);
            $data['events']=$this->model->getAllArticles($calc,intval($data['times']));
        }
    }
    else
    {
    $data['events']=$this->model->getAllArticles(0,10);
    }
    return $data;
  }

function modif (array $params) {
    if (isset($params[0])) {
      $article_id = intval($params[0]);

      // Récupérer l'evenement lié depuis le model
      if (!($data = $this->model->getArticle($article_id))) {
        return array();
      }

    // Get creator's name and id
    $data['creator'] = $this->model->getCreatorForArticle($data['id']);

      // Retourner les infos récupérées

      //print_r ($data);
      	 //recupere id utilisateur
	 $session = System::getSession();
		if ($session->isConnected()) {
		$user_id = $_SESSION['userid'];
		}
     //recupere infos sur evenements crees par utilisateur
     $data['evenements'] = $this->model->getUserEvents($user_id);
      return $data;
    }
    else{echo false;}
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
        $id_article = $article_id;
        $truc=$this->model->modifArticle($data,$id_article);

	    return array('id' => $id_article, 'error' => $errors);
   }
   else {}
   }
 }

  function delete(array $params) {
    if (isset($params[0])) {
      $id_event = intval($params[0]);
      $delete = $this->model->deleteArticle($id_event);
      ?>
      <script>
      window.history.back();
      </script>
      <?php
    }

  }

}

?>
