<section id='sectionpage'>
<h1>Mon Compte</h1>
<a href='<?php echo Config::get('config.base'); ?>/user/myprofil' class='boutoncompte'>Retourner sur mon profil</a>
<h2  class='voirmesevents'>Les événements que j'ai créé</h1>
  <section>
      <ul>
        <?php foreach($model['eventscreation'] as $value) { ?>
          <li>
              <div class="poster_evenement">
                <img class='poster_evenement_image' src="<?php echo $value['poster'];?>" alt = "poster de l'événement"/>
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
<h2 class='voirmesevents'>Les événements où je suis inscrit</h1>
  <section>
      <ul>
        <?php if($model['existenceinscription'] == true){ ?>
        <?php foreach($model['eventsinscrit'] as $value) { ?>
          <li>
              <div class="poster_evenement">
                <img class='poster_evenement_image' src="<?php echo $value['poster'];?>" alt = "poster de l'événement"/>
              </div>
              <div class="event_text">
                 <p><?php echo $value['nom']; ?></p>
                 <p><?php echo $value['ville']; ?></p>
                 <p><?php echo $value['date_debut']; ?></p>
              </div>
          </li>
       <?php } } else{  ?>
         <p> Vous ne vous êtes toujours pas inscrit à un événement !</p>
         <?php } ?>
       </ul>
   </section>
<h2 class='voirmesevents'>Les événements où j'ai participé</h1>
  <section>
      <ul>
        <?php if($model['existenceinscription'] == true){ ?>
        <?php foreach($model['eventspasse'] as $value) { ?>
          <li>
              <div class="poster_evenement">
                <img class='poster_evenement_image' src="<?php echo $value['poster'];?>" alt = "poster de l'événement"/>
              </div>
              <div class="event_text">
                 <p><?php echo $value['nom']; ?></p>
                 <p><?php echo $value['ville']; ?></p>
                 <p><?php echo $value['date_debut']; ?></p>
              </div>
          </li>
       <?php }} else{ ?>
         <p> Vous n'avez participé à aucun événement pour l'instant !</p>
         <?php } ?>
       </ul>
   </section>
</section>
