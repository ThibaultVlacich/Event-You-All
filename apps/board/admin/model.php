<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the admin Model for the app "board".
 *
 * @package apps/board/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-03-01-2016
 */

class BoardAdminModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }

  /**
   * Ajouter un commentaire
   */
  public function addMessage($message) {
    $prep = $this->db->prepare('
      INSERT INTO admin_messages
      (author_id, text, date)
      VALUES (:author_id, :text, NOW())
    ');

    $author_id = $_SESSION['userid'];

    $prep->bindParam(':author_id', $author_id, PDO::PARAM_INT);
    $prep->bindParam(':text', $message);

    $prep->execute();
  }

  /**
   * Obtenir la liste des commentaires
   */
  public function getMessages($from = 0, $number = 9999999, $order = 'date', $asc = true, $where_clause = '') {
    $prep = $this->db->prepare('
      SELECT *
      FROM admin_messages
      '.$where_clause.'
      ORDER BY '.$order.' '.($asc ? 'ASC' : 'DESC').'
      LIMIT :from, :number
    ');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);
    $prep->execute();

    $messages = $prep->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as &$message) {
      $prep = $this->db->prepare('SELECT * FROM users WHERE id = :user_id');
      $prep->bindParam(':user_id', $message['author_id']);
      $prep->execute();

      $message['author'] = $prep->fetch(PDO::FETCH_ASSOC);

      $date_timestamp = strtotime($message['date']);

      $message['date'] = strftime('%d %b %Y', $date_timestamp);
      $message['heure'] = strftime('%H:%M', $date_timestamp);
    }

    return $messages;
  }


  public function userCount() {
    $prep = $this->db->prepare('SELECT * FROM users');

    $prep->execute();

    return $prep->rowCount();
  }

  public function eventCount() {
    $prep = $this->db->prepare('SELECT * FROM evenements');

    $prep->execute();

    return $prep->rowCount();
  }

  public function articleCount() {
    $prep = $this->db->prepare('SELECT * FROM articles');

    $prep->execute();

    return $prep->rowCount();
  }

  public function topicCount() {
    $prep = $this->db->prepare('SELECT * FROM forum_topics');

    $prep->execute();

    return $prep->rowCount();
  }

  public function messageCount() {
    $prep = $this->db->prepare('SELECT * FROM forum_messages');

    $prep->execute();

    return $prep->rowCount();
  }
}

?>
