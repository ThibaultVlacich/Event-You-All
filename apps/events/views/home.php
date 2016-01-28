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
    <section>
      <h2 class="title">Faire une recherche</h2>
      <form action="<?php echo Config::get('config.base'); ?>/search/advancedsearch" method="get">
        <div class="search-form">
          <select name="region" class="large">
            <option disabled selected hidden>Région</option>
            <?php foreach($model['regions'] as $region) { ?><option value="<?php echo $region['id']; ?>"><?php echo $region['nom']; ?></option><?php } ?>
          </select>
          <select name="theme" class="large">
            <option disabled selected hidden>Thème</option>
            <?php foreach($model['themes'] as $theme) { ?><option value="<?php echo $theme['id']; ?>"><?php echo $theme['nom']; ?></option><?php } ?>
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
          <input type="submit" value="Rechercher">
        </div>
      </form>
    </section>
    <section>
      <h2 class="title">
        Les événements à venir
        <?php
          $session = System::getSession();

          if($session->isConnected()) {
            if(isset($model['user_region']) && !empty($model['user_region'])) {
              echo ' dans votre région ('.$model['regions'][$model['user_region']]['nom'].')';
            }
            echo '<a href="'.Config::get('config.base').'/events/create" class="create"><i class="fa fa-plus"></i> Ajouter un événement</a>';
          }
        ?>
      </h2>
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
        <?php if (empty($model['events'])) { ?>
          <p class="no-events">Aucun événement n'a encore été créé !</p>
        <?php } ?>
      </ul>
      <?php
        // Pagination
        $numberOfPages = ceil($model['total'] / $model['per_page']);
      ?>
      <ul class="num_page">
          <?php
            for($n = 1; $n <= $numberOfPages; $n++) {
              if ($n == $model['current_page']) {
          ?>
          <li class="current"><?php echo $n; ?></li>
          <?php
              } else {
          ?>
          <li><a href="<?php echo Config::get('config.base'); ?>/events/page/<?php echo $n; ?>"><?php echo $n; ?></a></li>
          <?php
              }
            }
          ?>
      </ul>
    </section>
  </div>
</div>
