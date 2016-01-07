<?php
  if (!empty($model['banniere'])) {
  ?>
  <div class="banner">
    <img src="<?php echo $model['banniere']; ?>" alt="<?php echo $model['nom']; ?>" />
  </div>
  <?php
  }
  ?>

<div id="entete">
  <h1>
    <?php echo $model['nom']; ?>
  </h1>
</div>
  <div class="bouton">
  <?php
            $session = System::getSession();

            if($session->isConnected()) {
              // User is logged in
              $user_id = $_SESSION['userid'];

              if ($model['creator']['id'] == $user_id) {
                // User is the creator
          ?>
          <a class="button" href="<?php echo Config::get('config.base'); ?>/article/modif/<?php echo $model['id']; ?>">Modifier l'article</a>
          <?php
            }}?>
 </div>
<div id="contenu">
  <p id="description">
    <?php echo $model['contenu']; ?>
  </p>
</div>
<ul id="signer">
  <li>
    <div id=avatar_organisateur></div>
  </li>
  <li>
    <h3>Mr.Jones :</h3>
  </li>
  <li>
    <div class="bouton">
      <a href="<?php echo Config::get('config.base'); ?>/user/profil/<?php echo $model['id_createur']?>">Voir la page de l'organisateur</a>
    </div>
  </li>
  <li>
    <div class="bouton">
      <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $model['id_evenement']?>">Voir la page de l'évenement</a>
    </div>
  </li>
  <!--insérer note de l'auteur-->
</ul>
</div>
