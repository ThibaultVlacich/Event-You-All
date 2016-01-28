<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "forum".
 *
 * @package apps/forum
 * @author Léo Plouvier <leo.plouvier@isep.fr>
 * @version 1.1.0-07-01-2015
 */

class ForumModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  public function createTopic(array $data) {
    $prep = $this->db->prepare('
     INSERT INTO forum_topics (titre,description,date_creation,id_createur)
     VALUES (:titre,:description,NOW(),:id_createur)
   ');

    $session = System::getSession();
    if ($session->isConnected()) {
      $user_id = $_SESSION['userid'];
    }

    $prep->bindParam(':titre', $data['titre']);
    $prep->bindParam(':description', $data['description']);
    $prep->bindParam(':id_createur', $user_id);
    

    if ($prep->execute()) {
      return $this->db->lastInsertId('id');
    } else {
      return false;
    }
  }

  public function countTopics() {
    $prep = $this->db->prepare('SELECT * FROM forum_topics');

    $prep->execute();

    return $prep->rowCount();
  }
  public function countMessages($topic_id) {
    $prep = $this->db->prepare('SELECT * FROM forum_messages WHERE id_topic = :topic_id');
    $prep->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
    $prep->execute();

    return $prep->rowCount();
  }

  public function getTopic($topic_id) {
    $prep = $this->db->prepare('SELECT * FROM forum_topics WHERE id = :topic_id');

    $prep->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
    $prep->execute();

    $topic = $prep->fetch(PDO::FETCH_ASSOC);

    return $topic;
 }

 public function getTopics($from = 0, $number = 9999999, $order = 'date_creation', $asc = false) {
   $prep = $this->db->prepare('
     SELECT *
     FROM forum_topics
     ORDER BY '.$order.' '.($asc ? 'ASC' : 'DESC').'
     LIMIT :from, :number
   ');

   $prep->bindParam(':from', $from, PDO::PARAM_INT);
   $prep->bindParam(':number', $number, PDO::PARAM_INT);
   $prep->execute();

   return $prep->fetchAll(PDO::FETCH_ASSOC);
 }
 public function getCreatorForTopic($topic_id) {
   $prep = $this->db->prepare('SELECT users.nickname, users.id FROM users INNER JOIN forum_topics ON  users.id = forum_topics.id_createur WHERE forum_topics.id = :topic_id');
   $prep->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
   $prep->execute();
   return $prep->fetch(PDO::FETCH_ASSOC);
 }

  public function addComment($topic_id, array $data) {
    $prep = $this->db->prepare('
      INSERT INTO forum_messages (message,date,id_createur,id_topic)
      VALUES (:message,NOW(),:id_createur,:id_topic)
    ');

    $session = System::getSession();
    if ($session->isConnected()) {
     $user_id = $_SESSION['userid'];
    }

    $prep->bindParam(':message', $data['message']);
    $prep->bindParam(':id_createur',$user_id);
    $prep->bindParam(':id_topic',$topic_id);

    if ($prep->execute()) {
      return $this->db->lastInsertId('id');
    } else {
      return false;
    }
  }

  public function getComment($comment_id) {
    $prep = $this->db->prepare('SELECT * FROM forum_messages WHERE id = :comment_id');

    $prep->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $prep->execute();

    $comment = $prep->fetch(PDO::FETCH_ASSOC);

    return $comment;
  }

  public function getComments($topic_id, $from = 0, $number = 9999999, $order = 'date', $asc = true) {
    $prep = $this->db->prepare('
      SELECT *
      FROM forum_messages
      WHERE id_topic = :topic_id
      ORDER BY '.$order.' '.($asc ? 'ASC' : 'DESC').'
      LIMIT :from, :number
    ');

    $prep->bindParam(':topic_id', $topic_id);
    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);
    $prep->execute();

    return $prep->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getCreatorForComments($comment_id) {
    $prep = $this->db->prepare('SELECT users.nickname, users.id FROM users INNER JOIN forum_messages ON  users.id = forum_messages.id_createur WHERE forum_messages.id = :comment_id');
    $prep->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function getAvatarForCreator($user_id){
    $prep = $this->db->prepare('SELECT photoprofil FROM users WHERE id = :user_id');
    $prep->bindParam(':user_id',$user_id);
    $prep->execute();
    return $prep->fetch(PDO::FETCH_ASSOC);
  }

  public function deleteTopic($topic_id){
    $prep = $this->db->prepare('DELETE FROM forum_topics WHERE id = :topic_id');
    $prep->bindParam(':topic_id',$topic_id);
    $prep->execute();
    $prep = $this->db->prepare('DELETE FROM forum_messages WHERE id_topic = :topic_id');
    $prep->bindParam(':topic_id',$topic_id);
    $prep->execute();
    return 'deleted';
  }
  public function deleteComment($comment_id){
    $prep = $this->db->prepare('DELETE FROM forum_messages WHERE id = :comment_id');
    $prep->bindParam(':comment_id',$comment_id);
    $prep->execute();
    return 'deleted';
  }
}
?>
