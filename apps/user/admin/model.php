<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "user".
 *
 * @package apps/user/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 1.1.0-12-01-2016
 */

require APPS_DIR.'user/model.php';

class UserAdminModel extends UserModel {

  /**
   * Obtenir la liste des utilisateurs
   */
  public function getUsers($from = 0, $number = 9999999, $order = 'register_date', $asc = true, $where_clause = '') {
    $prep = $this->db->prepare('
      SELECT *
      FROM users
      '.$where_clause.'
      ORDER BY '.$order.' '.($asc ? 'ASC' : 'DESC').'
      LIMIT :from, :number
    ');

    $prep->bindParam(':from', $from, PDO::PARAM_INT);
    $prep->bindParam(':number', $number, PDO::PARAM_INT);
    $prep->execute();

    $users = $prep->fetchAll(PDO::FETCH_ASSOC);

    return $users;
  }

  /**
   * Obtenir le nombre d'utilisateurs inscrits
   */
  public function countUsers() {
    $prep = $this->db->prepare('SELECT * FROM users');

    $prep->execute();

    return $prep->rowCount();
  }

  public function updateUser($user_id, $data) {
    $prep = $this->db->prepare('
      UPDATE users
      SET
        access    = :access,
        email     = :email,
        lastname  = :lastname,
        firstname = :firstname
      WHERE id = :user_id
    ');

    $prep->bindParam(':access', $data['access'], PDO::PARAM_INT);
    $prep->bindParam(':email', $data['email']);
    $prep->bindParam(':lastname', $data['lastname']);
    $prep->bindParam(':firstname', $data['firstname']);

    $prep->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    $prep->execute();
  }

  public function updateUserPassword($user_id, $password) {
    $prep = $this->db->prepare('UPDATE users SET password = :password WHERE id = :user_id');

    $password_hashed = sha1($password);

    $prep->bindParam(':password', $password_hashed);
    $prep->bindParam(':user_id', $user_id);

    $prep->execute();
  }

  public function deleteUser($user_id) {
    $prep = $this->db->prepare('DELETE FROM users WHERE id = :user_id');

    $prep->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    $prep->execute();

    // Then remove all its content from the database
    $this->db->query('DELETE FROM admin_messages WHERE author_id = '.intval($user_id));
    $this->db->query('DELETE FROM articles WHERE id_createur = '.intval($user_id));
    $this->db->query('DELETE FROM evenements WHERE id_createur = '.intval($user_id));
    $this->db->query('DELETE FROM forum_topics WHERE id_createur = '.intval($user_id));
    $this->db->query('DELETE FROM forum_messages WHERE id_createur = '.intval($user_id));
    $this->db->query('DELETE FROM evenements_participants WHERE id_utilisateur = '.intval($user_id));
    $this->db->query('DELETE FROM evenements_notes WHERE id_utilisateur = '.intval($user_id));

  }

}
?>
