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
    //found will be having the SQL Request
    //SQL Initial Request (while have to be modified in case advancedresearch is empty)
//----------------------Initialisation of found--------------------------------------
    if($advancedsearch['advancedsearch'] !== ''){
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE (evenements.nom LIKE :advancedsearch  OR  evenements.description LIKE :advancedsearch)
      ';
      }
    elseif ($advancedsearch['city'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.ville LIKE :city';
    }
    elseif ($advancedsearch['theme'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.id = evenements_genres.id_evenement
            AND evenements_genres.id_genre = genres.id
            AND genres.nom LIKE :theme';
    }
    elseif ($advancedsearch['type'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.id = evenements_types.id_evenement
            AND evenements_types.id_type = types.id
            AND types.nom LIKE :type';
    }
    elseif ($advancedsearch['nbr_place_min'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.capacite > :nbr_place_min ';
    }
    elseif ($advancedsearch['nbr_place_max'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.capacite < :nbr_place_max';
    }
    elseif ($advancedsearch['prix_min'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.prix > :prix_min';
    }
    elseif ($advancedsearch['prix_max'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.prix < :prix_max';
    }
    elseif ($advancedsearch['region'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.region LIKE :region';
    }
    elseif ($advancedsearch['zip_code'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.code_postal LIKE :zip_code';
    }
    elseif ($advancedsearch['organisateur'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.id_createur = users.id
            AND (users.nickname LIKE :organisateur OR users.firstname LIKE :organisateur OR users.lastname LIKE :organisateur)';
    }
    elseif ($advancedsearch['sponsors'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE AND evenements.id = evenements_sponsors.id_evenement
            AND evenements_sponsors.id_sponsor = sponsors.id
            AND sponsors.nom LIKE :sponsors';
    }
    elseif ($advancedsearch['date_event'] !== '') {
      $found1='
      SELECT evenements.nom, evenements.ville, evenements.date_debut, evenements.poster FROM evenements,evenements_genres,genres,evenements_types,types,users,evenements_sponsors,sponsors
      WHERE evenements.date_debut = :date_event';
    }
//-------------------End of the Initialisation-------------------------


//------------------Check if other fields have been filled-----------------------

    //If city isn't empty, it must be considered in the SQL Request.
    if($advancedsearch['city'] == ''){
      $found2=$found1; //if its not, nothing is done
    }
    else{
      $found2=$found1.'AND evenements.ville LIKE :city'; //add the end next part of the SQL request, only if city isn't empty
    }

//Do it again for all the others fields of the array
    if($advancedsearch['theme'] == ''){
      $found3=$found2;
    }
    else{
      $found3=$found2.'AND evenements.id = evenements_genres.id_evenement
                       AND evenements_genres.id_genre = genres.id
                       AND genres.nom LIKE :theme';
    }

    if($advancedsearch['type'] == ''){
      $found4=$found3;
    }
    else{
      $found4=$found3.'AND evenements.id = evenements_types.id_evenement
                       AND evenements_types.id_type = types.id
                       AND types.nom LIKE :type';
    }

    if($advancedsearch['nbr_place_max'] == '' && $advancedsearch['nbr_place_min'] == ''){
      $found5 = $found4;
    }
    else{
      if($advancedsearch['nbr_place_max'] == ''){//case where only min number has been filled
        $found5 = $found4.'AND evenements.capacite > :nbr_place_min';
      }
      else{
        if($advancedsearch['nbr_place_min'] ==''){//case where only max number has been filled
          $found5 = $found4.'AND evenements.capacite < :nbr_place_max';
        }
        else{//case where max and min has been filled
          $found5 = $found4.'AND evenements.capacite < nbr_place_max
                             AND evenements.capacite > nbr_place_min';
        }
      }
    }

    if($advancedsearch['prix_max'] == '' && $advancedsearch['prix_min'] == ''){
      $found6 = $found5;
    }
    else{
      if($advancedsearch['prix_max'] == ''){//case where only min number has been filled
        $found6 = $found5.'AND evenements.prix > :prix_min';
      }
      else{
        if($advancedsearch['prix_min'] == ''){//case where only max number has been filled
          $found6 = $found5.'AND evenements.prix < :prix_max';
        }
        else{//case where max and min has been filled
          $found6 = $found5.'AND evenements.prix < prix_max
                             AND evenements.prix > prix_min';
        }
      }
    }

    if($advancedsearch['region'] == ''){
      $found7 = $found6;
    }
    else{
      $found7=$found6.'AND evenements.region LIKE :region'; //add the end next part of the SQL request
    }

    if($advancedsearch['zip_code'] == ''){
      $found8=$found7;
    }
    else{
      $found8=$found7.'AND evenements.code_postal LIKE :zip_code'; //add the end next part of the SQL request
    }

    if($advancedsearch['date_event'] == ''){
      $found9=$found8;
    }
    else{
      $found9=$found8.'AND evenements.date_debut LIKE :date_event'; //add the end next part of the SQL request
    }

    if($advancedsearch['organisateur'] == ''){
      $found10=$found9;
    }
    else{
      $found10=$found9.'AND evenements.id_createur = users.id
                        AND (users.nickname LIKE :organisateur OR users.firstname LIKE :organisateur OR users.lastname LIKE :organisateur)';
    }

    if($advancedsearch['sponsors'] == ''){
      $found11 = $found10;
    }
    else{
      $found11 = $found10.'AND evenements.id = evenements_sponsors.id_evenement
                           AND evenements_sponsors.id_sponsor = sponsors.id
                           AND sponsors.nom LIKE :sponsors';
    }


    //Sends back the final sql request
    $prep = $this->db->prepare($found11);

    $filteredadvancedsearch = '%'.$advancedsearch['advancedsearch'].'%';

    $prep->bindParam(':advancedsearch',$filteredadvancedsearch);
    $prep->bindParam(':theme',$advancedsearch['theme']);
    $prep->bindParam(':city',$advancedsearch['city']);
    $prep->bindParam(':region',$advancedsearch['region']);
    $prep->bindParam(':zip_code',$advancedsearch['zip_code']);
    $prep->bindParam(':date_event',$advancedsearch['date_event']);
    $prep->bindParam(':prix_max',$advancedsearch['prix_max']);
    $prep->bindParam(':prix_min',$advancedsearch['prix_min']);
    $prep->bindParam(':nbr_place_min',$advancedsearch['nbr_place_min']);
    $prep->bindParam(':nbr_place_max',$advancedsearch['nbr_place_max']);
    $prep->bindParam(':organisateur',$advancedsearch['organisateur']);
    $prep->bindParam(':sponsors',$advancedsearch['sponsors']);
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
