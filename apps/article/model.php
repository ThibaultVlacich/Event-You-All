<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "article".
 *
 * @package apps/article
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 0.1.0-dev-12-12-2015
 */

//CODE A ADAPTER POUR ARTICLES
//TO DO
class ArticleModel {

  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }


  /**
   * Creates an event in the database.
   *
   * @param array $data
   * @return mixed ID of the event just created or false on failure
   */
	public function createEvent(array $data) {
		$prep = $this->db->prepare('
      INSERT INTO articles (nom,contenu)
		  VALUES (:nom,:contenu)
    ');

    $prep->bindParam(':nom', $data['nom']);
    $prep->bindParam(':contenu', $data['corps']);

    if ($prep->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
	}
	public function getArticle($article_id){
		$prep = $this->db->prepare('SELECT * FROM articles WHERE id = :article_id');

		$prep->bindParam(':article_id', $article_id, PDO::PARAM_INT);
		$prep->execute();

		$article = $prep->fetch(PDO::FETCH_ASSOC);

		return $article;
	}

}

?>
