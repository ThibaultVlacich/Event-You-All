<section id='sectionpage'>
<h1>Mon Compte</h1>
<a href='<?php echo Config::get('config.base'); ?>/user/myprofil' class='boutoncompte'>Retourner sur mon profil</a>
<h2  class='voirmesevents'>Les événements que j'ai créé</h1>
  <section>
      <ul class="events">
        <?php foreach($model['eventscreation'] as $event) { ?>
          <li>
            <div class="poster">
              <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><img src="<?php echo $event['poster']; ?>" alt=""></a>
            </div>
            <div class="caption">
              <?php if(isset($event['theme'])) { ?>                <span class="theme"><?php echo $event['theme']['nom']; ?></span><span class='theme'> <?php echo $event['type']['nom'];?></span><?php } ?>
              <h3><a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><?php echo $event['nom']; ?></a></h3>
              <?php
                if (( !empty($event['date_debut']) && empty($event['date_fin']) ) || ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] == $event['date_fin'] )) {
              ?>
              <div class="date">Le <?php echo $event['date_debut']; ?></div>
              <?php
                } else if ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] != $event['date_fin'] ) {
              ?>
              <div class="date">Du <?php echo $event['date_debut']; ?> au <?php echo $event['date_fin']; ?></div>
              <?php } ?>
            </div>
          </li>
       <?php } ?>
       </ul>
   </section>
<h2 class='voirmesevents'>Les événements où je suis inscrit</h1>
  <section>
      <ul class="events">
        <?php if($model['existenceinscription'] == true){ ?>
        <?php foreach($model['eventsinscrit'] as $event) { ?>
          <li>
            <div class="poster">
              <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><img src="<?php echo $event['poster']; ?>" alt=""></a>
            </div>
            <div class="caption">
              <?php if(isset($event['theme'])) { ?>
                <span class="theme"><?php echo $event['theme']['nom']; ?></span><span class='theme'> <?php echo $event['type']['nom'];?></span><?php } ?>
              <h3><a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><?php echo $event['nom']; ?></a></h3>
              <?php
                if (( !empty($event['date_debut']) && empty($event['date_fin']) ) || ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] == $event['date_fin'] )) {
              ?>
              <div class="date">Le <?php echo $event['date_debut']; ?></div>
              <?php
                } else if ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] != $event['date_fin'] ) {
              ?>
              <div class="date">Du <?php echo $event['date_debut']; ?> au <?php echo $event['date_fin']; ?></div>
              <?php } ?>
            </div>
          </li>
       <?php } } else{  ?>
         <p> Vous ne vous êtes toujours pas inscrit à un événement !</p>
         <?php } ?>
       </ul>
   </section>
<h2 class='voirmesevents'>Les événements où j'ai participé</h1>
  <section>
      <ul class="events">
        <?php if($model['existenceinscriptionpasse'] == true){ ?>
        <?php foreach($model['eventspasse'] as $event) { ?>
          <li>
            <div class="poster">
              <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><img src="<?php echo $event['poster']; ?>" alt=""></a>
            </div>
            <div class="caption">
              <?php if(isset($event['theme'])) { ?>  <span class="theme"><?php echo $event['theme']['nom']; ?></span><span class='theme'> <?php echo $event['type']['nom'];?></span><?php } ?>
              <h3><a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><?php echo $event['nom']; ?></a></h3>
              <?php
                if (( !empty($event['date_debut']) && empty($event['date_fin']) ) || ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] == $event['date_fin'] )) {
              ?>
              <div class="date">Le <?php echo $event['date_debut']; ?></div>
              <?php
                } else if ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] != $event['date_fin'] ) {
              ?>
              <div class="date">Du <?php echo $event['date_debut']; ?> au <?php echo $event['date_fin']; ?></div>
              <?php } ?>
            </div>
          </li>
       <?php }} else{ ?>
         <p> Vous n'avez participé à aucun événement pour l'instant !</p>
         <?php } ?>
       </ul>
   </section>
</section>
