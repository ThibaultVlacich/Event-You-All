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
    $prep = $this->db->prepare('INSERT INTO articles (nom,contenu,id_evenement,banniere,date_creation,id_createur) VALUES (:nom,:contenu,:event,
    :banniere,:date_creation,:creator)');
    
    $creation=date("Y-m-d H:i:s");
    $user_id = $_SESSION['userid'];
    
    $prep->bindParam(':nom', $data['nom']);
    $prep->bindParam(':contenu', $data['corps']);
    $prep->bindParam(':event', $data['arti']);
    $prep->bindParam(':banniere', $data['bann']);
    $prep->bindParam(':date_creation', $creation);
    $prep->bindParam(':creator',$user_id);

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
    //recuperer l'id lié au createur
  public function getCreatorForArticle($event_id) {
    $prep = $this->db->prepare('SELECT users.nickname, users.id FROM users INNER JOIN articles ON  users.id = articles.id_createur');
    $prep->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }
  
    public function oldban($event_id) {
    $prep = $this->db->prepare('SELECT banniere FROM articles WHERE id = '.$event_id.'');
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }
  
  public function modifArticle(array $data) {
    $prep = $this->db->prepare('
      UPDATE articles SET nom=:nom,contenu=:corps,id_evenement=:event,banniere=:bann WHERE id = :id_event
    ');

    $prep->bindParam(':nom', $data['nom']);
    $prep->bindParam(':corps', $data['corps']);
    $prep->bindParam(':event', $data['arti']);
    $prep->bindParam(':bann', $data['bann']);

    if ($prep->execute()) {

      return $data['id'];
    } else {
        echo 'non';
      return false;
    }
  }
}

?>
