    <section class="searchsection">
            <h1>Faire une recherche avancée</h1>
    <div class="search_h">
        <form method="GET" action = "<?php echo Config::get('config.base'); ?>/search/advancedsearch">
            <input type="search" name="advancedsearch" id="advancedsearch" placeholder="Recherche"/>
             <select  name='theme' id='theme'>
                    <option selected disabled>Thème</option>
                    <?php
 							  foreach ($model['theme'] as $proptheme) {
 							?>
                    <option value="<?php echo $proptheme['id']; ?>"<?php if($proptheme['id'] == $model['theme']) { echo ' selected'; } ?>><?php echo $proptheme['nom'];?></option>
                    <?php } ?>
            </select>
            <select name='type' id='type' name='type'>
                    <option selected disabled>Type</option>
                    <?php
 							  foreach ($model['type'] as $proptheme) {
 							?>
                    <option value="<?php echo $proptheme['id']; ?>"<?php if($proptheme['id'] == $model['type']) { echo ' selected'; } ?>><?php echo $proptheme['nom'];?></option>
                    <?php } ?>
            </select>
            <select name="date_de_j" id="date_de_j">
              <option disabled selected hidden>Jour</option>
              <?php
                for ($i = 1; $i <= 31; $i++) {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              ?>
            </select>
            <select name="date_de_m" id="date_de_m">
              <option disabled selected hidden>Mois</option>
              <?php
                $months = array(
                  1  => "Janvier",
                  2  => "Février",
                  3  => "Mars",
                  4  => "Avril",
                  5  => "Mai",
                  6  => "Juin",
                  7  => "Juillet",
                  8  => "Août",
                  9  => "Septembre",
                  10 => "Octobre",
                  11 => "Novembre",
                  12 => "Décembre"
                );

                foreach ($months as $number => $month) {
                  echo '<option value="'.$number.'">'.$month.'</option>';
                }
              ?>
            </select>
            <select name="date_de_a" id="date_de_a">
              <option disabled selected hidden>Année</option>
            <?php  for ($i = 2016; $i <= 2116; $i++) {
                echo '<option value="'.($i).'">'.($i).'</option>';
              } ?>
            </select>
            <input id='sendrecherche' type="submit" value="Recherche"/><br/>
            <select  name='region' id='region' name = 'region'>
               <option selected disabled>Région</option>
               <?php
             			  foreach ($model['region'] as $proptheme) {
             							?>
               <option value="<?php echo $proptheme['id']; ?>"<?php if($proptheme['id'] == $model['region']) { echo ' selected'; } ?>><?php echo $proptheme['nom'];?></option>
              <?php } ?>
            </select>
            <input type="text" placeholder="Ville" id='city' name = 'city'/>
            <input type="text" placeholder="Code Postal" id="zip_code" name = 'zip_code'/><br/>
            <input type="text" placeholder="Organisateur" id="organisateur" name = 'organisateur'/>
                        <input type='text' placeholder="Sponsor" id='sponsor' name='sponsor'/>
            <input type="int" placeholder="Prix minimum" id="prix_min" name = 'prix_min'/>
            <input type="int" placeholder="Prix maximum" id="prix_max" name='prix_max'/>
            <input type="int" placeholder="Nombre de places min" id='nbr_place_min' name = 'nbr_place_min'/>
            <input type="int" placeholder="Nombre de places max" id="nbr_place_max" name = 'nbr_place_max'/>
        </form>
    </div>
  </section>
  <?php if(!empty($model['error'])){
    echo $model['error'];
  }
  else{ ?>
     <section class='resultssearch'>
       <h1> Voici les résultats de votre recherche :</h1>
         <ul>
           <?php if(!empty($model['advancedresults'][0])){  foreach($model['advancedresults'] as $value) { ?>
             <li>
               <?php $lien='/events/detail/'.$value['id'];?>
                 <div class="poster_evenement">
                   <a class ='searchlien1' href="<?php echo Config::get('config.base').$lien; ?>"><img class ='poster_evenement_image' src="<?php echo $value['poster'];?>" alt = "poster de l'événement"/></a>
                 </div>
                 <div class="event_text">
                   <span class='theme'> <?php echo $value['theme']['nom'];?></span>
                   <span class='type'> <?php echo $value['type']['nom'];?></span>
                    <h2><a class ='searchlien2' href="<?php echo Config::get('config.base').$lien?>"><?php echo $value['nom']; ?></a></h2>
                    <p><?php echo $value['ville']; ?></p>
                    <p><?php echo $value['date_debut']; ?></p>
                 </div><div class ='clearer'></div>
             </li>

          <?php } ?></ul><div class ='clearer'></div>
          <div id='nosearchresults'><p>Si vous ne trouvez pas d'événement qui vous donne envie . N'attendez pas, créez l'événement dont vous rêvez dès maintenant en <a id='createmyevent' href='<?php echo Config::get('config.base'); ?>/events/create'> cliquant ici !</a></p></div>
        <?php }
else{ ?><div id='nosearchresults'><p>Aucun événement ne correspond à votre recherche. N'attendez pas, créez l'événement qui vous fait envie dès maintenant en <a id='createmyevent' href='<?php echo Config::get('config.base'); ?>/events/create'> cliquant ici !</a></p></div>
        <?php }?>
      <?php } ?>
    </section>
