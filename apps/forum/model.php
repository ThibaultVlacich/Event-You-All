<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "forum".
 *
 * @package apps/forum
 * @author Name of the author <author@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

// -> Need to replace here "Default" by the name of the app (capitalized)
class ForumModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  public function createTopic(array $data) {
    $prep = $this->db->prepare('
     INSERT INTO forum_topics (titre,description,date_creation,id_createur)
     VALUES (:titre,:description,:date_creation,:administrateur)
   ');

   $session = System::getSession();
	if ($session->isConnected()) {
	$user_id = $_SESSION['userid'];
  $date = DateTime::getTimestamp();
}
   $prep->bindParam(':titre', $data['titre']);
   $prep->bindParam(':description', $data['description']);
   $prep->bindParam(':date_creation', $date);
   $prep->bindParam(':administrateur', $user_id);

   if ($prep->execute()) {
     return $this->db->lastInsertId('id');
   } else {
     return false;
   }
 }

 public function getTopic($topic_id) {
   $prep = $this->db->prepare('SELECT * FROM forum_topics WHERE id = :topic_id');

   $prep->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
   $prep->execute();

   $topic = $prep->fetch(PDO::FETCH_ASSOC);

   return $topic;
 }

 public function getTopics($from = 0, $number = 9999999, $order = 'date_creation', $asc = true) {
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

  // Then add methods (can be named whatever you want)
}

?>
