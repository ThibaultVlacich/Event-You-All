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
      <a href="#">Voir la page de l'organisateur</a>
    </div>
  </li>
  <li>
    <div class="bouton">
      <a href="#">Voir la page de l'évenement</a>
    </div>
  </li>
  <!--insérer note de l'auteur-->
</ul>
</div>
