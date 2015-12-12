<div class="app-events app-events-detail">
  <?php
  if (!empty($model['banniere'])) {
  ?>
  <div class="banner">
    <img src="<?php echo $model['banniere']; ?>" alt="<?php echo $model['nom']; ?>" />
  </div>
  <?php
  }
  ?>
  <div class="event-wrapper">
    <div class="event-main">
      <section class="event-detail-infos">
        <h2 class="title">Informations</h2>
        <div class="poster">
          <img src="<?php echo $model['poster']; ?>" alt="<?php echo $model['nom']; ?>" />
        </div>
        <div class="details">
          <h2 class="nom"><?php echo $model['nom']; ?></h2>
          <ul class="fa-ul">
            <li><i class="fa fa-li fa-calendar-o"></i> Le <?php echo $model['date_debut']; ?></li>
            <li><i class="fa fa-li fa-clock-o"></i> &Agrave; <?php echo $model['heure_debut']; ?></li>
            <li><i class="fa fa-li fa-money"></i> <?php echo $model['prix']; ?>&nbsp;€</li>
          </ul>
        </div>
      </section>
      <?php
      if(!empty($model['adresse']) && !empty($model['code_postal']) && !empty($model['ville'])) {
        $adresse_encoded = urlencode($model['adresse'].' '.$model['code_postal'].' '.$model['ville']);
      ?>
      <section class="event-map">
        <h2 class="title">Localisation</h2>
        <a href="http://google.com/maps?q=<?php echo $adresse_encoded; ?>" target="_blank">
          <img src="https://maps.googleapis.com/maps/api/staticmap?language=fr&amp;size=600x185&amp;scale=2&amp;zoom=15&amp;markers=<?php echo $adresse_encoded; ?>" class="map" alt="" />
        </a>
        <div class="adresse-container">
          <?php echo $model['adresse']; ?><br>
          <?php echo $model['code_postal'].' '.$model['ville']; ?>
        </div>
      </section>
      <?php } ?>
      <?php if(!empty($model['description'])) { ?>
      <section class="description">
        <h2 class="title">Description</h2>
        <p>
          <?php echo $model['description']; ?>
        </p>
      </section>
      <?php } ?>
    </div>
    <aside class="event-column">
      <section class="block">
        <h2 class="title">Participer à cet événement</h2>
        <div class="register">
          <a href="<?php echo Config::get('config.base'); ?>/events/register/<?php echo $model['id']; ?>">S'inscrire à l'événement</a>
        </div>
      </section>
      <section class="block">
        <h2 class="title">Partager cet événement</h2>
        <div class="share-buttons">
          <a class="fa fa-twitter" title="Partager sur Twitter" data-text="<?php echo $model['nom']; ?>"></a>
          <a class="fa fa-facebook" title="Facebook"></a>
          <a class="fa fa-google-plus" title="Partager sur Google+"></a>
        </div>
      </section>
    </aside>
  </div>
</div>
