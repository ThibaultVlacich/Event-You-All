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
//This function only consider the input advancedsearch and city and will have to be extended to consider the other inputs
  public function advancedsearchindatabase($advancedsearch) {

    //SQL Initial Request (while have to be modified in case advancedresearch is empty)
    $found1='
    SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements
    WHERE (evenements.nom LIKE :advancedsearch  OR  evenements.description LIKE :advancedsearch)
    ';

    //If city isn't empty, it must be considered in the SQL Request.
    //My problem : DOESN'T WORK YET!
    if(!is_null($advancedsearch['city'])){
      $found2=$found1.'AND evenements.ville LIKE :city'; //add the end next part of the SQL request
    }
    else{
      $found2=$found1;
    }

    //Sends back the final sql request
    $prep = $this->db->prepare($found2);

    $filteredadvancedsearch = '%'.$advancedsearch['advancedsearch'].'%';

    $prep->bindParam(':advancedsearch',$filteredadvancedsearch);
    $prep->bindParam(':city',$advancedsearch['city']);

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
