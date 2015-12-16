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

     $id_article = $this->model->createEvent($data);
	 
	 return array('id' => $id_article);
   }
 }

 function index() {

 }

}

?>
