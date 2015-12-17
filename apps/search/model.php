<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the Model for the app "Search".
 *
 * @package apps/search
 * @author Hugo Michard <hugomichard@isep.fr>
 * @version 0.1.0-dev-dd-mm-yyyy
 */

class SearchModel {
  protected $db;

  public function __construct() {
    $this->db = System::getDb();
  }
//SQL request probleme
  public function advancedsearchindatabase(array $data) {
    $prep = $this->db->prepare('
      SELECT * FROM evenements,evenements_sponsors,evenements_photos,evenements_genres,users,sponsors
      WHERE (   nom LIKE %:advancedsearch%
            OR  description LIKE %:advancedsearch%)
          AND region = :region
          AND code_postal = :zip_code
          AND date_debut = :date_event
          AND prix >= :prix_min
          AND prix <= :prix_max
          AND capacite >= :nbr_place_min
          AND capacite <= :nbr_place_max
          AND ville = :city
          AND users.id = evenements.id_createur
          AND evenements_photos.id_evenement = evenements.id
          AND evenements_sponsors.id_evenement = evenements.id
          AND sponsors.id = evenements_sponsors.id_sponsor

    ');

    //SQL request if only a couple of words have been entered in the top-right search tool
    public function basicsearchindatabase($search) {
      $prep = $this->db->prepare('
        SELECT nom, ville, date_debut,poster  FROM evenements WHERE
            nom LIKE %:search%
        OR  date_debut = :search
        OR  description LIKE %:search%
        OR  adresse LIKE %:search%
        OR  ville LIKE %:search%
        OR  mot_clef LIKE %:search%
        OR  region LIKE %:search%
        OR  pays LIKE %:search%
        ORDER BY ville
      ');

      $prep->bindParam(':search',$search);

      $prep->execute();

      $nb_resultats=mysql_num_rows($prep);

    }
  }

  // Then add methods (can be named whatever you want)
}

?>
