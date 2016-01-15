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
    $found = 'SELECT nom, ville, date_debut, poster, id_theme, id_type,id FROM evenements WHERE ';
    $longueur = 82;

    if (!empty($advancedsearch['theme'])) {
      $found .= ' id_theme = '.intval($advancedsearch['theme']);
    }

    if(!empty($advancedsearch['advancedsearch'])){
      if(strlen($found) < $longueur+1){
        $found.=  '(evenements.nom LIKE "%'.addslashes($advancedsearch['advancedsearch']).'%"' .' OR  evenements.description LIKE "%'.addslashes($advancedsearch['advancedsearch']).'%"'.')';
      }
      else{
        $found.=  ' AND (evenements.nom LIKE "%'.addslashes($advancedsearch['advancedsearch']).'%"' .' OR  evenements.description LIKE "%'.addslashes($advancedsearch['advancedsearch']).'%"'.')';
      }
    }

    if (!empty($advancedsearch['city'])) {
      if(strlen($found) < $longueur+1){
        $found .= 'ville LIKE "'.addslashes($advancedsearch['city']).'"';
      }
      else{
        $found .= ' AND ville LIKE "'.addslashes($advancedsearch['city']).'"';
      }
    }

    if (!empty($advancedsearch['type'])) {
      if(strlen($found) < $longueur+1){
        $found .= 'id_type = '.intval($advancedsearch['type']);
      }
      else{
        $found .= ' AND id_type = '.intval($advancedsearch['type']);
      }
    }

    if(!empty($advancedsearch['region'])){
      if(strlen($found) < $longueur+1){
        $found .= 'region = '.intval($advancedsearch['region']);
      }
      else{
        $found .= ' AND region LIKE '.intval($advancedsearch['region']);
      }
    }

    if (!empty($advancedsearch['nbr_place_max'])) {
      if(strlen($found) < $longueur+1){
        $found .= 'capacite < '.intval($advancedsearch['nbr_place_max']);
      }
      else{
        $found .= ' AND capacite < '.intval($advancedsearch['nbr_place_max']);
      }
    }

    if (!empty($advancedsearch['nbr_place_min'])) {
      if(strlen($found) < $longueur+1){
        $found .= 'capacite > '.intval($advancedsearch['nbr_place_min']);
      }
      else{
        $found .= ' AND capacite > '.intval($advancedsearch['nbr_place_min']);
      }
    }

    if (!empty($advancedsearch['prix_min'])) {
      if(strlen($found) < $longueur+1){
        $found .= 'prix > '.intval($advancedsearch['prix_min']);
      }
      else{
        $found .= ' AND prix > '.intval($advancedsearch['prix_min']);
      }
    }

    if (!empty($advancedsearch['prix_max'])) {
      if(strlen($found) < $longueur+1){
        $found .= 'prix < '.intval($advancedsearch['prix_max']);
      }
      else{
        $found .= ' AND prix < '.intval($advancedsearch['prix_max']);
      }
    }

    if (!empty($advancedsearch['zip_code'])) {
      if(strlen($found) < $longueur+1){
        $found .= 'code_postal LIKE '.intval($advancedsearch['zip_code']);
      }
      else{
        $found .= ' AND code_postal LIKE '.intval($advancedsearch['zip_code']);
      }
    }

    $k=0;
    if(!empty($advancedsearch['organisateur'][$k]['id'])){
      if(strlen($found) < $longueur+1){
        $found .= 'id = '.intval($advancedsearch['organisateur'][$k]['id']);
        $k += 1;
      }
      else{
        $found .= ' AND id = '.intval($advancedsearch['organisateur'][$k]['id']);
        $k += 1;
      }
      while(!empty($advancedsearch['organisateur'][$k+1]['id'])){
        $found .= ' OR id = '.intval($advancedresearch['organisateur'][$k]['id']);
        $k += 1;
      }
      if(!empty($advancedsearch['organisateur'][$k]['id'])){
        $found .= ' OR id = '.intval($advancedsearch['organisateur'][$k]['id']);
      }
    }

    $k=0;
    if(!empty($advancedsearch['sponsor_evenement_id'][$k]['id_evenement'])){
      if(strlen($found) < $longueur+1){
        $found .= 'id = '.intval($advancedsearch['sponsor_evenement_id'][$k]['id_evenement']);
        $k += 1;
      }
      else{
        $found .= ' AND id = '.intval($advancedsearch['sponsor_evenement_id'][$k]['id_evenement']);
        $k += 1;
      }
      while(!empty($advancedsearch['sponsor_evenement_id'][$k+1]['id_evenement'])){
        $found .= ' OR id = '.intval($advancedresearch['sponsor_evenement_id'][$k]['id_evenement']);
        $k += 1;
      }
      if(!empty($advancedsearch['sponsor_evenement_id'][$k]['id_evenement'])){
        $found .= ' OR id = '.intval($advancedsearch['sponsor_evenement_id'][$k]['id_evenement']);
      }
    }

    $k=0;
    if(!empty($advancedsearch['date_evenement_id'][$k])){
      if(strlen($found) < $longueur+1){
        $found .= 'id = '.intval($advancedsearch['date_evenement_id'][$k]);
        $k += 1;
      }
      else{
        $found .= ' AND id = '.intval($advancedsearch['date_evenement_id'][$k]);
        $k += 1;
      }
      while(!empty($advancedsearch['date_evenement_id'][$k+1])){
        $found .= ' OR id = '.intval($advancedresearch['date_evenement_id'][$k]);
        $k += 1;
      }
      if(!empty($advancedsearch['date_evenement_id'][$k])){
        $found .= ' OR id = '.intval($advancedsearch['date_evenement_id'][$k]);
      }
    }

    if(strlen($found) < $longueur+1){
      $found = 'SELECT nom, ville, date_debut, poster, id_theme, id_type,id FROM evenements';
    }
//-------------------End of the Initialisation-------------------------
    //Sends back the final sql request
    $prep = $this->db->prepare($found);
    $prep->execute();
    return $prep->fetchAll(PDO::FETCH_ASSOC);

  }

  public function getIDeventforDate(){
    $prep = $this->db->prepare('SELECT id,date_debut FROM evenements');

    $prep->execute();
    return $prep->fetchAll(PDO::FETCH_ASSOC);
  }

    public function getthemewithid($id_theme){
      $prep = $this->db->prepare('SELECT nom FROM themes WHERE id = :id_theme');
      $prep->bindParam(':id_theme',$id_theme);
      $prep->execute();
      return $prep->fetch(PDO::FETCH_ASSOC);
    }

    public function gettypewithid($id_type){
      $prep = $this->db->prepare('SELECT nom FROM types WHERE id = :id_type');
      $prep->bindParam(':id_type',$id_type);
      $prep->execute();
      return $prep->fetch(PDO::FETCH_ASSOC);
    }

    public function gettheme(){
      $prep = $this->db->prepare('SELECT id, nom, afficher FROM themes');
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gettype(){
      $prep = $this->db->prepare('SELECT id, nom, afficher FROM types');
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getregion(){
      $prep = $this->db->prepare('SELECT id, nom, afficher FROM regions');
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserID($organisateur){
      $prep = $this->db->prepare('SELECT evenements.id FROM evenements INNER JOIN users ON evenements.id_createur = users.id WHERE users.nickname LIKE :organisateur
      OR users.firstname LIKE :organisateur
      OR users.lastname LIKE :organisateur
      ');
      $prep->bindParam(':organisateur',$organisateur);
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventwithSponsor($sponsor){
      $prep = $this->db->prepare('SELECT id_evenement FROM evenements_sponsors INNER JOIN sponsors ON evenements_sponsors.id_sponsor = sponsors.id WHERE sponsors.nom LIKE :sponsor');

      $filtered = '%'.$sponsor.'%';
      $prep->bindParam(':sponsor',$filtered);
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    //SQL request if only a couple of words have been entered in the top-right search tool
    public function basicsearchindatabase($search) {
      $prep = $this->db->prepare('SELECT nom, ville, date_debut,poster,id_theme,id_type,id  FROM evenements WHERE
            nom LIKE :search
        OR  date_debut = :search
        OR  description LIKE :search
        OR  adresse LIKE :search
        OR  ville LIKE :search
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
