<div class="app-events app-events-home">
  <div class="slideshow-container">
    <div class="slideshow">
      <?php foreach($model['slideshow'] as $event) { ?>
        <img src="<?php echo $event['banniere']; ?>" alt="<?php echo $event['nom']; ?>" />
      <?php } ?>
    </div>
    <a class="fa fa-chevron-left slidesjs-previous slidesjs-navigation" href="#" title="Précédent"></a>
    <a class="fa fa-chevron-right slidesjs-next slidesjs-navigation" href="#" title="Suivant"></a>
  </div>
  <ul class="events">
    <?php foreach($model['events'] as $event) { ?>
      <li>
        <div class="poster">
          <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><img src="<?php echo $event['poster']; ?>" alt=""></a>
        </div>
        <div class="caption">
          <span class="theme">Concert</span>
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
