<div class="app-events app-events-home">
  <?php if(!empty($model['slideshow'])) { ?>
  <div class="slideshow-container">
    <div class="slideshow">
    <?php foreach($model['slideshow'] as $event) { ?>
      <img src="<?php echo $event['banniere']; ?>" alt="<?php echo $event['nom']; ?>" />
    <?php } ?>
    </div>
    <div class="slideshow-details">
    <?php
      $count = 1;
      foreach($model['slideshow'] as $event) {
    ?>
      <div class="slide slide-<?php echo $count; ?>">
        <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>">
          <div class="caption">
            <div class="caption-wrapper">
              <?php if(isset($event['theme'])) { ?><span class="theme"><?php echo $event['theme']['nom']; ?></span><?php } ?>
              <h2><?php echo $event['nom']; ?></h2>
            </div>
          </div>
        </a>
      </div>
    <?php
        $count++;
      }
    ?>
    </div>
    <a class="fa fa-chevron-left slidesjs-previous slidesjs-navigation" href="#" title="Précédent"></a>
    <a class="fa fa-chevron-right slidesjs-next slidesjs-navigation" href="#" title="Suivant"></a>
  </div>
  <?php } ?>
  <div class="home-wrapper">
    <h2 class="title">Faire une recherche</h2>
    <form action="<?php echo Config::get('config.base'); ?>/search" method="get">
      <div class="search-form">
        <select name="region">
          <option disabled selected hidden>Région</option>
          <?php foreach($model['regions'] as $region) { ?><option value="<?php echo $region['id']; ?>"><?php echo $region['nom']; ?></option><?php } ?>
        </select>
        <select name="theme">
          <option disabled selected hidden>Thème</option>
          <?php foreach($model['themes'] as $theme) { ?><option value="<?php echo $theme['id']; ?>"><?php echo $theme['nom']; ?></option><?php } ?>
        </select>
        <input type="date" name="date" placeholder="Date">
        <input type="submit" value="Rechercher">
      </div>
    </form>
    <h2 class="title">Les événements à venir</h2>
    <ul class="events">
      <?php foreach($model['events'] as $event) { ?>
        <li>
          <div class="poster">
            <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><img src="<?php echo $event['poster']; ?>" alt=""></a>
          </div>
          <div class="caption">
            <?php if(isset($event['theme'])) { ?><span class="theme"><?php echo $event['theme']['nom']; ?></span><?php } ?>
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
  </div>
</div>
