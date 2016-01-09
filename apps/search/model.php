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

    if (!empty($advancedsearch['theme'])) {
      $found .= ' id_theme = '.intval($advancedsearch['theme']);
    }

    if(!empty($advancedsearch['advancedsearch'])){
      if($found<65){
        $found.=  '(evenements.nom LIKE "%'.addslashes($advancedsearch['advancedsearch']).'%"' .' OR  evenements.description LIKE "%'.addslashes($advancedsearch['advancedsearch']).'%"'.')';
      }
      else{
        $found.=  ' AND (evenements.nom LIKE "%'.addslashes($advancedsearch['advancedsearch']).'%"' .' OR  evenements.description LIKE "%'.addslashes($advancedsearch['advancedsearch']).'%"'.')';
      }
    }

    if (!empty($advancedsearch['city'])) {
      if($found<65){
        $found .= 'ville LIKE "'.addslashes($advancedsearch['city']).'"';
      }
      else{
        $found .= ' AND ville LIKE "'.addslashes($advancedsearch['city']).'"';
      }
    }

    if (!empty($advancedsearch['type'])) {
      if($found<65){
        $found .= 'id_type = '.intval($advancedsearch['type']);
      }
      else{
        $found .= ' AND id_type = '.intval($advancedsearch['type']);
      }
    }

    if(!empty($advancedsearch['region'])){
      if($found<65){
        $found .= 'region = '.intval($advancedsearch['region']);
      }
      else{
        $found .= ' AND region LIKE '.intval($advancedsearch['region']);
      }
    }

    if (!empty($advancedsearch['nbr_place_max'])) {
      if($found<65){
        $found .= 'capacite < '.intval($advancedsearch['nbr_place_max']);
      }
      else{
        $found .= ' AND capacite < '.intval($advancedsearch['nbr_place_max']);
      }
    }

    if (!empty($advancedsearch['nbr_place_min'])) {
      if($found<65){
        $found .= 'capacite > '.intval($advancedsearch['nbr_place_min']);
      }
      else{
        $found .= ' AND capacite > '.intval($advancedsearch['nbr_place_min']);
      }
    }

    if (!empty($advancedsearch['prix_min'])) {
      if($found<65){
        $found .= 'prix > '.intval($advancedsearch['prix_min']);
      }
      else{
        $found .= ' AND prix > '.intval($advancedsearch['prix_min']);
      }
    }

    if (!empty($advancedsearch['prix_max'])) {
      if($found<65){
        $found .= 'prix < '.intval($advancedsearch['prix_max']);
      }
      else{
        $found .= ' AND prix < '.intval($advancedsearch['prix_max']);
      }
    }

    if (!empty($advancedsearch['zip_code'])) {
      if($found<65){
        $found .= 'code_postal LIKE '.intval($advancedsearch['zip_code']);
      }
      else{
        $found .= ' AND code_postal LIKE '.intval($advancedsearch['zip_code']);
      }
    }

    if (!empty($advancedsearch['organisateur'])) {
      if($found>65){
        $found .= ' AND ';
      }
      $nbrcaserestants = count($advancedsearch['organisateur']);
      while ($nbrcaserestants > 1) {
        $found .= ' evenements.id_createur = '.intval($advancedsearch['organisateur'][$nbrcaserestants-1]).' OR ';          $nbrcaserestants = $nbrcaserestants - 1;
      }
      $found .= ' evenements.id_createur = '.intval($advancedsearch['organisateur'][0]);
    }

    if (!empty($advancedsearch['date_event'])) {
      if($found<65){
        $found .= 'date_debut = "'.$advancedsearch['date_event'].'"';
      }
      else{
        $found .= ' AND date_debut = "'.$advancedsearch['date_event'].'"';
      }
    }


//-------------------End of the Initialisation-------------------------
    //Sends back the final sql request
    $prep = $this->db->prepare($found);
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
      $prep = $this->db->prepare('SELECT id, nom FROM themes');
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gettype(){
      $prep = $this->db->prepare('SELECT id, nom FROM types');
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getregion(){
      $prep = $this->db->prepare('SELECT id, nom FROM regions');
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserID($organisateur){
      $prep = $this->db->prepare('
      SELECT id FROM users WHERE nickname LIKE :organisteur
      OR firstname LIKE :organisateur
      OR lastname LIKE :organisateur
      ');
      $prep->bindParam(':organisateur',$organisateur);
      $prep->execute();
      return $prep->fetchAll(PDO::FETCH_ASSOC);
    }

    //SQL request if only a couple of words have been entered in the top-right search tool
    public function basicsearchindatabase($search) {
      $prep = $this->db->prepare('SELECT nom, ville, date_debut,poster  FROM evenements WHERE
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
