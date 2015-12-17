<div class="app-groupes app-groupes-detail">
  <div class="groupe-wrapper">
      <div class="groupe-main">
        <section class="groupes-detail-infos">
          <div class="poster">
            <img src="<?php echo $model['poster']; ?>" alt="<?php echo $model['nom']; ?>" />
          </div>
          <div class="details">
            <h2 class="nom"><?php echo $model['nom']; ?></h2>
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
              <?php if ($model['prix'] > 0) { ?><li><i class="fa fa-li fa-money"></i> <?php echo $model['prix']; ?>&nbsp;€</li><?php } ?>
              <?php if ($model['capacite'] > 0) { ?><li><i class="fa fa-li fa-users"></i> <?php echo $model['capacite']; ?> places</li><?php } ?>
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
            <i class="fa fa-map-marker"></i>
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
        <section class="event-news">
          <h2 class="title">Articles</h2>
          <?php
          if (isset($model['articles']) && !empty($model['articles'])) {
            foreach ($model['articles'] as $article) {
          ?>
          <article>
            <h3><?php echo $article['nom']; ?></h3>
            <p>
              <?php echo $article['contenu']; ?>
            </p>
          </article>
          <?php
            }
          } else {
          ?>
            <p>
              Aucun article n'a encoré été ajouté pour ce groupe !
            </p>
          <?php
          }
          ?>
        </section>
      </div>
      <aside class="groupes-column">
        <section class="block">
          <h2 class="title">Rejoindre ce groupe</h2>
          <div class="register">
            <?php
              $session = System::getSession();

              if($session->isConnected()) {
            ?>
            <a class="button" href="<?php echo Config::get('config.base'); ?>/groupes/register/<?php echo $model['id']; ?>">Rejoindre le groupe</a>
            <?php
              } else {
            ?>
            <a class="button disabled">Rejoindre le groupe</a>
            <p><a href="<?php echo Config::get('config.base'); ?>/user/login">Connectez-vous</a> pour pouvoir rejoindre ce groupe !</p>
            <?php
              }
            ?>
          </div>
        </section>
      </aside>
    </div>
  </div>
</div>
