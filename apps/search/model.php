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
  public function advancedsearchindatabase($advancedsearch) {
    $prep = $this->db->prepare('
      SELECT nom, ville, date_debut, poster FROM evenements,evenements_sponsors,evenements_photos,evenements_genres,users,sponsors,evenements_types,types
      WHERE (   nom LIKE search  OR  description LIKE :search)

          AND evenements.region = :region
          AND evenements.code_postal = :zip_code
          AND evenements.ville = :city

          AND evenements.date_debut = :date_event

          AND evenements.prix >= :prix_min
          AND evenements.prix <= :prix_max

          AND evenements.capacite >= :nbr_place_min
          AND evenements.capacite <= :nbr_place_max

          AND (users.nickname = :organisateur OR users.firstname = :organisateur OR users.lastname = :organisateur)
          AND users.id = evenements.id_createur


          AND evenements_photos.id_evenement = evenements.id

          AND sponsors.nom = :sponsors
          AND evenements_sponsors.id_evenement = evenements.id
          AND sponsors.id = evenements_sponsors.id_sponsor

          AND genres.nom = :genre
          AND evenements_genres.id_evenement = evenements.id
          AND evenements_genre.id_genre = genres.id

          AND types.nom = :type
          AND evenements_types.id_type = types.id
          AND evenements_types.id_evenement = evenements.id

    ');

    $filtered2 = '%'.$advancedsearch['advancedsearch'].'%';

    $prep->bindParam(':search',$filtered2);
    $prep->bindParam(':region',$advancedsearch['region']);
    $prep->bindParam(':zip_code',$advancedsearch['zip_code']);
    $prep->bindParam(':date_event',$advancedsearch['date_event']);
    $prep->bindParam(':prix_max',$advancedsearch['prix_max']);
    $prep->bindParam(':prix_min',$advancedsearch['prix_min']);
    $prep->bindParam(':nbr_place_min',$advancedsearch['nbr_place_max']);
    $prep->bindParam(':nbr_place_max',$advancedsearch['nbr_place_max']);
    $prep->bindParam(':city',$advancedsearch['city']);
    $prep->bindParam(':organisateur',$advancedsearch['organisateur']);
    $prep->bindParam(':sponsors',$advancedsearch['sponsors']);
    $prep->bindParam(':genre',$advancedsearch['theme']);
    $prep->bindParam(':type',$advancedsearch['type']);

    $prep->execute();
    return $prep->fetchAll(PDO::FETCH_ASSOC);

      }

    //SQL request if only a couple of words have been entered in the top-right search tool
    public function basicsearchindatabase($search) {
      $prep = $this->db->prepare('
        SELECT nom, ville, date_debut,poster  FROM evenements WHERE
            nom LIKE :search
        OR  date_debut = :search
        OR  description LIKE :search
        OR  adresse LIKE :search
        OR  ville LIKE :search
        OR  mot_clef LIKE :search
        OR  region LIKE :search
        OR  pays LIKE :search
        ORDER BY ville
      ');

      $filtered = '%'.$search['search'].'%';

      $prep->bindParam(':search',$filtered);

      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }
  }
?>
