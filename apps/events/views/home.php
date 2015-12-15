<div class="app-events app-events-home">
  <div class="slideshow">
    <img src="http://blogs.paris.fr/unitedstatesofparis/files/2014/09/Soir%C3%A9e-The-Underwater-2-les-myst%C3%A8res-des-fonds-marins-by-Agence-Wato-We-are-the-Oracle-%C3%A9v%C3%A9nement-clubbing-nuit-Piscine-Pailleron-photo-by-United-States-of-Paris.jpg" alt="">
    <img src="http://www.104.fr/data/classes/evenement/evenement_392_image.jpg" alt="">
  </div>
  <ul class="events">
    <?php foreach($model as $event) { ?>
      <li>
        <div class="poster">
          <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><img src="<?php echo $event['poster']; ?>" alt=""></a>
        </div>
        <div class="caption">
          <h2><a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><?php echo $event['nom']; ?></a></h2>
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
</div>
