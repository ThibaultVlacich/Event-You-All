<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "article".
 *
 * @package apps/article
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 0.1.0-dev-12-12-2015
 */

class ArticleModel {

  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }


  /**
   * Creates an article in the database.
   *
   * @param array $data
   * @return mixed ID of the article just created or false on failure
   */
   public function createEvent(array $data) {
    $prep = $this->db->prepare('INSERT INTO articles (nom,contenu,id_evenement) VALUES (:nom,:contenu,:event)');

    $prep->bindParam(':nom', $data['nom']);
    $prep->bindParam(':contenu', $data['corps']);
	$prep->bindParam(':event', $data['arti']);

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
  
  public function getUserEvents($user_id){
    $prep = $this->db->prepare('SELECT * FROM evenements WHERE id_createur = :user_id');

    $prep->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $prep->execute();

    $events = $prep->fetchAll(PDO::FETCH_ASSOC);

    return $events;
  }
}

?>
