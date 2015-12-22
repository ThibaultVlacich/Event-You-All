    <section class="searchsection">
    <div class="search_h">
        <form method="GET" action = "<?php echo Config::get('config.base'); ?>/search/advancedsearch">
            <input type="search" name="advancedsearch" id="advancedsearch" placeholder="Recherche"/>
             <select  name='theme' id='theme'>
                    <option selected disabled>Thème</option>
                    <optgroup label='Musique'/>
                        <option value='classique'>Classique</option>
                        <option value='metal'>Metal</option>
                        <option value='rock'>Rock</option>
                        <option value='autres_m'>Autres</option>
                    <optgroup label='Cinema'/>
                        <option value='action'>Action</option>
                        <option value='thriller'>Thriller</option>
                        <option value='familial'>Familial</option>
                        <option value='comedie'>Comedie</option>
                        <option value='autres_c'>Autres</option>
                    <optgroup label='Image'/>
                        <option value='peinture'>Peinture</option>
                        <option value='photographie'>Photographie</option>
                        <option value='autres_i'>Autres</option>
            </select>
            <select name='type' id='type' name='type'>
                    <option selected disabled>Type</option>
                    <option value='concert'>Concert</option>
                    <option value='plein-air'>Plein-air</option>
                    <option value='visite'>Visite</option>
            </select>
            <input type="date" placeholder="Date" id="date_event" name='date'/>
            <input type="submit" value="Recherche"/><br/>
            <select  name='region' id='region' name = 'region'>
               <option selected disabled>Région</option>
               <option value=''>Île-de-France</option>
               <option value=''>Berry</option>
            </select>
            <input type="text" placeholder="Ville" id='city' name = 'city'/>
            <input type="text" placeholder="Code Postal" id="zip_code" name = 'zip_code'/><br/>
            <input type="text" placeholder="Organisateur" id="organisateur" name = 'organisateur'/>
            <input type="int" placeholder="Prix minimum" id="prix_min" name = 'prix_min'/>
            <input type="int" placeholder="Prix maximum" id="prix_max" name='prix_max'/>
            <input type="int" placeholder="Nombre de places min" id='nbr_place_min' name = 'nbr_place_min'/>
            <input type="int" placeholder="Nombre de places max" id="nbr_place_max" name = 'nbr_place_max'/>
            <input type="int" placeholder="Partenaires et sponsors" id="sponsors" name = 'sponsors'><br/>
        </form>
    </div>
  </section>
     <section>
         <ul>
           <?php foreach($model as $value) { ?>
             <li>
                 <div class="poster_evenement">
                   <img class='poster_evenement_image' src="<?php echo $value['poster']; ?>" alt = "poster de l'événement"/>
                 </div>
                 <div class="event_text">
                    <p><?php echo $value['nom']; ?></p>
                    <p><?php echo $value['ville']; ?></p>
                    <p><?php echo $value['date_debut']; ?></p>
                 </div>
             </li>
          <?php } ?>
          </ul>
      </section>
