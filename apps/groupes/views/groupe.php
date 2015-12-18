<div class="app-groupes app-groupes-detail">
  <div class="groupe-wrapper">
      <div class="groupe-main">
        <section class="groupes-detail-infos">
          <div class="details">
            <h2 class="nom"></h2>
            <ul class="fa-ul">
            
            </ul>
          </div>
        </section>
        <?php
        if(!empty($model['adresse']) && !empty($model['code_postal']) && !empty($model['ville'])) {
          $adresse_encoded = urlencode($model['adresse'].' '.$model['code_postal'].' '.$model['ville']);
        ?>
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
              L'article a vocation à résumer les caractéristiques d'un groupe.
            </p>
          <?php
          }
          ?>
        </section>
      </div>
      <aside class="groupes-column">
        <section class="block">
          
          <div class="register">
            <?php
              $session = System::getSession();

              if($session->isConnected()) {
            ?>
            <a class="button" href="<?php echo Config::get('config.base'); ?>/groupes/register/<?php echo $model['id']; ?>">Rejoindre le groupe</a>
            <?php
              } else {
            ?>
            <a class="button disabled">Rejoindre ce groupe</a>
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
