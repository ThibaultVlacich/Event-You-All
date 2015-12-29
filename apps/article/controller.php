<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Controller for the app "article".
 *
 * @package apps/article
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 0.1.0-dev-12-12-2015
 */

class ArticleController extends Controller {
  var $default_module = 'index';

  var $access = array(
    'create'         => 1,
    'create_confirm' => 1
  );

 function detail(array $params) {

   if (isset($params[0])) {
     $article_id = intval($params[0]);

     // Récupérer l'article lié depuis le model
     $data = $this->model->getArticle($article_id);

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
     $data += Request::getAssoc(array('bann','mclef'));
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
      //----------------------------------------------------------------------------(fin banniere)
      
      
     $id_article = $this->model->createEvent($data);
	 
	 return array('id' => $id_article,'error' => $errors);
   }
 }

 function index() {

 }

}

?>
