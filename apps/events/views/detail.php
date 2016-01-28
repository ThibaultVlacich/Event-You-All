<?php
  $session = System::getSession();
?>
<div class="app-events app-events-detail">
  <?php
    if (empty($model)) {
      // No event based on asked id
  ?>
  <div class="note error">
    <i class="fa fa-exclamation-triangle"></i>
    <ul>
      <li>L'événement demandé n'existe pas !</li>
    </ul>
  </div>
  <?php
      return;
    }

    if (!empty($model['vip'])) {
      if (!($session->isConnected())) {
  ?>
  <div class="note error">
    <i class="fa fa-exclamation-triangle"></i>
    <ul>
      <li>Vous ne pouvez pas accéder à cet événement!</li>
    </ul>
  </div>
  <?php
        return;
      } else {
        $user_name = $_SESSION['nickname'];
        $user_id   = $_SESSION['userid'];
        $access    = $_SESSION['access'];

        if (!(in_array($user_name, explode(",", $model['vip']))) && $access != 3 && $model['id_createur'] != $user_id) {
  ?>
  <div class="note error">
    <i class="fa fa-exclamation-triangle"></i>
    <ul>
      <li>Vous ne pouvez pas accéder à cet événement!</li>
    </ul>
  </div>
  <?php
          return;
        }
      }
    }

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
        <div class="poster">
          <img src="<?php echo $model['poster']; ?>" alt="<?php echo $model['nom']; ?>" />
        </div>
        <div class="details">
          <h2 class="nom"><?php echo $model['nom']; ?></h2>
          <?php if (!empty($model['creator'])) { ?><span class="creator">&Eacute;vénement publié par <a href="<?php echo Config::get('config.base'); ?>/user/profile/<?php echo $model['creator']['id']; ?>"><?php echo $model['creator']['nickname']; ?></a></span><?php } ?>
          <ul class="fa-ul">
            <li>
              <i class="fa fa-li fa-calendar-o"></i>
              <?php
                if (( !empty($model['date_debut']) && empty($model['date_fin']) ) || ( !empty($model['date_debut']) && !empty($model['date_fin']) && $model['date_debut'] == $model['date_fin'] )) {
              ?>
                Le <?php echo $model['date_debut']; ?>
              <?php
                } else if ( !empty($model['date_debut']) && !empty($model['date_fin']) && $model['date_debut'] != $model['date_fin'] ) {
              ?>
                Du <?php echo $model['date_debut']; ?> au <?php echo $model['date_fin']; ?>
              <?php
                }
              ?>
            </li>
            <li>
              <i class="fa fa-li fa-clock-o"></i>
              <?php
                if (( !empty($model['heure_debut']) && empty($model['heure_fin']) ) || ( !empty($model['heure_debut']) && !empty($model['heure_fin']) && $model['heure_debut'] == $model['heure_fin'] )) {
              ?>
                &Agrave; <?php echo $model['heure_debut']; ?>
              <?php
                } else if ( !empty($model['heure_debut']) && !empty($model['heure_fin']) && $model['heure_debut'] != $model['heure_fin'] ) {
              ?>
                De <?php echo $model['heure_debut']; ?> &agrave; <?php echo $model['heure_fin']; ?>
              <?php
                }
              ?>
            </li>
            <li><i class="fa fa-li fa-money"></i> <?php echo (($model['prix'] == 0) ? 'Gratuit' : $model['prix'].'&nbsp;€'); ?></li>
            <?php if ($model['capacite'] > 0) { ?><li><i class="fa fa-li fa-users"></i> <?php echo $model['capacite']; ?> places (<?php echo ($model['capacite'] - $model['number_of_participants']); ?>&nbsp;restantes)</li><?php } ?>
            <?php if (!empty($model['site_web'])) { ?><li><i class="fa fa-li fa-external-link"></i> <a href="<?php echo $model['site_web']; ?>" target="_blank">Site internet</a></li><?php } ?>
            <?php if ($model['rate']) { ?><li><i class="fa fa-li fa-star"></i> Note de l'événement : <?php echo round($model['rate']); ?>/5</li><?php } ?>
          </ul>
          <?php if(!empty($model['description'])) { ?>
          <div class="description">
            <h2 class="title">Description</h2>
            <div class="description-content">
              <?php echo $model['description']; ?>
            </div>
            <a href="#" class="readmore">En lire <i class="fa fa-plus"></i></a>
          </div>
          <?php } ?>
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
          <i class="fa fa-map-marker"></i>
          <?php echo $model['adresse']; ?><br>
          <?php echo $model['code_postal'].' '.$model['ville']; ?>
        </div>
      </section>
      <?php } ?>
      <section class="gallery">
        <h2 class="title">
          Gallerie photos
          <?php
            if($session->isConnected()) {
              // User is logged in
              $user_id = $_SESSION['userid'];

              if ($model['user_already_registered'] OR $user_id == $model['id_createur']) {
                // User is registered to the event
          ?>
          <a class="ajouter" href="<?php echo Config::get('config.base'); ?>/events/uploadphoto/<?php echo $model['id']; ?>"><i class="fa fa-plus"></i> Télécharger une photo</a>
          <?php
              }
            }
          ?>
        </h2>
        <?php if (!empty($model['photos'])) { ?>
        <div class="photo-gallery">
          <?php foreach ($model['photos'] as $photo) { ?><div data-src="<?php echo $photo['url']; ?>"><div class="camera_caption"><?php echo $photo['nom']; ?></div></div><?php } ?>
        </div>
        <?php } else { ?>
        Aucune photo n'a encore été ajouté à cet événement !
        <?php } ?>
      </section>
      <section class="event-news">
        <h2 class="title">
          Articles
          <?php
            if($session->isConnected()) {
              // User is logged in
              $user_id = $_SESSION['userid'];

              if ($model['creator']['id'] == $user_id) {
                // User is the creator
          ?>
          <a class="ajouter" href="<?php echo Config::get('config.base'); ?>/article/create"><i class="fa fa-plus"></i> Ajouter un article</a>
          <?php
              }
            }
          ?>
          </h2>
        <?php
        if (isset($model['articles']) && !empty($model['articles'])) {
          foreach ($model['articles'] as $article) {
        ?>
        <article>
          <h3><a href="<?php echo Config::get('config.base'); ?>/article/detail/<?php echo $article['id']?>"><?php echo $article['nom']; ?></a></h3>
          <p>
            <?php echo substr($article['contenu'],0,500) ; if (strlen($article['contenu'])>500){echo '...';} ?>
          </p>
        </article>
        <?php
          }
        } else {
        ?>
          <p>
            Aucun article n'a encoré été ajouté pour cet événement !
          </p>
        <?php
        }
        ?>
      </section>
    </div>
    <aside class="event-column">
      <section class="block">
        <h2 class="title">Participer à cet événement</h2>
        <div class="register">
          <?php
            if($session->isConnected()) {
              // User is logged in
              $user_id = $_SESSION['userid'];

              if ($model['id_createur'] == $user_id) {
                // User is the creator
          ?>
          <a class="button" href="<?php echo Config::get('config.base'); ?>/events/modif/<?php echo $model['id']; ?>">Modifier l'événement</a>
          <?php
              }
                        if ($model['id_createur'] == $user_id) {
                // User is the creator
          ?>
          <a class="button" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet événement ?'));" href="<?php echo Config::get('config.base'); ?>/events/delete/<?php echo $model['id']; ?>">Effacer l'événement</a>
          <?php
              }

              if($model['user_already_registered']) {
          ?>
          <a class="button" href="<?php echo Config::get('config.base'); ?>/events/unregister/<?php echo $model['id']; ?>">Se désinscrire de l'événement</a>
          <?php
              } else {
                if (($model['capacite'] > $model['number_of_participants']) OR $model['capacite'] == 0) {
                  // There is still place in the event
          ?>
          <a class="button" href="<?php echo Config::get('config.base'); ?>/events/register/<?php echo $model['id']; ?>">S'inscrire à l'événement</a>
          <?php
                } else {
                  // There is no place left
          ?>
          <a class="button disabled">S'inscrire à l'événement</a>
          <p>Vous ne pouvez pas vous inscrire à cet événement, ce dernier étant plein !</p>
          <?php
                }
              }
            } else {
              // User is not logged in
          ?>
          <a class="button disabled">S'inscrire à l'événement</a>
          <p><a href="<?php echo Config::get('config.base'); ?>/user/login">Connectez-vous</a> pour pouvoir vous inscrire à cet événement !</p>
          <?php
            }
          ?>
        </div>
      </section>
      <?php
      if ($session->isConnected() && !$model['user_rate'] && $model['user_already_registered']) {
        // Display the rate block only if the user is connected
        // and if he has not already rated the event and if he is registered to the event
      ?>
      <section class="block">
        <h2 class="title">Noter cet événement</h2>
        <div class="rating">
          <a href="<?php echo Config::get('config.base'); ?>/events/rate/<?php echo $model['id']; ?>/?note=5" title="Give 5 stars"><i class="fa fa-star"></i></a>
          <a href="<?php echo Config::get('config.base'); ?>/events/rate/<?php echo $model['id']; ?>/?note=4" title="Give 4 stars"><i class="fa fa-star"></i></a>
          <a href="<?php echo Config::get('config.base'); ?>/events/rate/<?php echo $model['id']; ?>/?note=3" title="Give 3 stars"><i class="fa fa-star"></i></a>
          <a href="<?php echo Config::get('config.base'); ?>/events/rate/<?php echo $model['id']; ?>/?note=2" title="Give 2 stars"><i class="fa fa-star"></i></a>
          <a href="<?php echo Config::get('config.base'); ?>/events/rate/<?php echo $model['id']; ?>/?note=1" title="Give 1 star"><i class="fa fa-star"></i></a>
        </div>
      </section>
      <?php } ?>
      <section class="block">
        <h2 class="title">Partager cet événement</h2>
        <div class="share-buttons">
          <a class="fa fa-twitter" title="Partager sur Twitter" data-text="<?php echo $model['nom']; ?>"></a>
          <a class="fa fa-facebook" title="Facebook"></a>
          <a class="fa fa-google-plus" title="Partager sur Google+"></a>
        </div>
      </section>
      <?php
        if ($session->isConnected()) { ?>
      <section class="block">
        <h2 class="title">Contacter l'organisateur</h2>
        <div class="contact">
          <a class="button" href="<?php echo Config::get('config.base'); ?>/events/contactorganisateur/<?php echo $model['id']; ?>">Envoyer un mail</a>
        </div>
      </section>
      <?php } ?>
    </aside>
  </div>
</div>
