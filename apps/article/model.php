<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "article".
 *
 * @package apps/article
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 1.1.0-12-12-2015
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

  /**
   * Obtenir le nombre d'articles créés
   */
  public function countArticles() {
    $prep = $this->db->prepare('SELECT * FROM articles');

    $prep->execute();

    return $prep->rowCount();
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
    $prep = $this->db->prepare('SELECT users.nickname, users.id, users.photoprofil FROM users INNER JOIN articles ON  users.id = articles.id_createur
    WHERE users.id=:event_id');
    $prep->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function modifArticle(array $data,$id) {
    $prep = $this->db->prepare('
      UPDATE articles SET nom=:nom,contenu=:corps WHERE id = :id_article
    ');

    $prep->bindParam(':nom', $data['nom']);
    $prep->bindParam(':corps', $data['corps']);
    $prep->bindParam(':id_article', $id);

    if(!empty($data['bann'])) {
      $prep2 = $this->db->prepare('
        UPDATE articles SET banniere = :bann WHERE id = :id_article
      ');

      $prep2->bindParam(':bann', $data['bann']);
      $prep2->bindParam(':id_article', $id);

      $prep2->execute();
    }

    if ($prep->execute()) {
      return $id;
    } else {
        echo 'non';
      return false;
    }
  }
  public function deleteArticle($id) {
      $prep = $this->db->prepare('DELETE FROM articles WHERE id = :id');

        $prep->bindParam(':id', $id);
        $prep->execute();
        return 'deleted';

  }

  //-------------------vip---------------
  public function getVip($event_id){

    $prep = $this->db->prepare('SELECT users.nickname FROM users LEFT OUTER JOIN evenements_vip ON
    users.id = evenements_vip.id_utilisateur WHERE :id=evenements_vip.id_evenement');
    $prep->bindParam(':id', $event_id);
    $prep->execute();
    $vips = $prep->fetchAll(PDO::FETCH_ASSOC);
    $newsp=array();
    foreach ($vips as $vip)
    {
        $newsp[] = $vip['nickname'];
    }
    $vips=implode (',',$newsp);
    return $vips;
  }

  //----------------liste articles--------------


  public function getArticles($from = 0, $number = 9999999, $order = 'date_creation', $asc = true, $where_clause = '') {
    $prep = $this->db->prepare('
      SELECT * FROM articles
      '.$where_clause.'
      ORDER BY '.$order.' '.($asc ? 'ASC' : 'DESC').'
      LIMIT :from, :number
    ');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);
    $prep->execute();

    $events = $prep->fetchAll(PDO::FETCH_ASSOC);

    foreach ($events as &$event) {
      // Get event linked for the article
      if (!empty($event['id_evenement'])) {
        $prep = $this->db->prepare('SELECT * FROM evenements WHERE id = :id_theme');

        $prep->bindParam(':id_theme', $event['id_evenement']);
        $prep->execute();

        $event['event'] = $prep->fetch(PDO::FETCH_ASSOC);
      }

      // Get creator of the article infos
      if (!empty($event['id_createur'])) {
        $prep = $this->db->prepare('SELECT * FROM users WHERE id = :id_user');

        $prep->bindParam(':id_user', $event['id_createur']);
        $prep->execute();

        $event['author'] = $prep->fetch(PDO::FETCH_ASSOC);
      }

    }

    //---------filtre-------------
      $resultat=$events;
      $filtered=array();

      //recupere tableau vip
      $prep2 = $this->db->prepare('SELECT * FROM evenements_vip');
      $prep2->execute();
      $priv=$prep2->fetchAll(PDO::FETCH_ASSOC);

      //recupere id event vip
      $id_vip=array();
      foreach($priv as $vipid){
          $id_vip[]=$vipid['id_evenement'];
      }

      //regarder si privé si le cas enlever si pas dans vip
      foreach($resultat as $result)
      {
          if (!in_array($result['id_evenement'],$id_vip))
          {
              $filtered[]=$result;
          }
          else{
              //recupere tableau vip d'users
              $prep21 = $this->db->prepare('SELECT id_utilisateur FROM evenements_vip');
              $prep21->execute();
              $priv1=$prep21->fetchAll(PDO::FETCH_ASSOC);
              $id_vip2=array();
              foreach($priv1 as $vipid){$id_vip2[]=$vipid['id_utilisateur'];}
              $session = System::getSession();
              if (($session->isConnected())) {
              $user_id=$_SESSION['userid'];
              if (in_array($user_id,$id_vip2) or $_SESSION['access']==3 or $result['id_createur']==$user_id){
                  $filtered[]=$result;
              }}
          }

      }
      return $filtered;
  }
}

?>
