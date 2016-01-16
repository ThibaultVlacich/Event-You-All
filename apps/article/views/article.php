<?php
  $session = System::getSession();
if (empty($model['id'])) {
    echo'<div class="note error">
    <i class="fa fa-exclamation-triangle"></i>
    <ul>
      <li>Cet article n\'existe pas!</li>
    </ul>
  </div>';
  return ;
    
} ?>
  <?php
    if (!empty($model['vip'])) {
        if (!($session->isConnected())) {
  ?>
  <div class="note error">
    <i class="fa fa-exclamation-triangle"></i>
    <ul>
      <li>Vous ne pouvez pas accéder à cet article!</li>
    </ul>
  </div>
  <?php
      return;
    }
    }
  ?>
  

      <?php
    if (!empty($model['vip'])) {
        if($session->isConnected()) {
              $user_name = $_SESSION['nickname'];
              $user_id = $_SESSION['userid'];
              $access_id = $_SESSION['access'];
    if (!(in_array($user_name,explode(",",$model['vip']))) and ($access_id!=3) and $model['id_createur']!=$user_id){
  ?>
  <div class="note error">
    <i class="fa fa-exclamation-triangle"></i>
    <ul>
      <li>Vous ne pouvez pas accéder à cet article!</li>
    </ul>
  </div>
  <?php
      return;
    }
    }
    }
  ?>
 <?php
  if (!empty($model['banniere']) and $model['banniere']!=NULL) {
  ?>
  <div class="banner">
    <img src="<?php echo $model['banniere']; ?>" alt="<?php echo $model['nom']; ?>" />
  </div>
  <?php }?>
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
            }
                         if ($model['creator']['id'] == $user_id) {
                // User is the creator
          ?>
          <a class="button" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet article ?'));" href="<?php echo Config::get('config.base'); ?>/article/deleted/<?php echo $model['id']; ?>">Effacer l'article</a>
          <?php
              }
            
            }?>
 </div>
<div id="contenu">
  <p id="description">
    <?php echo $model['contenu']; ?>
  </p>
</div>
<ul id="signer">
  <li>
    <div id=avatar_organisateur><?php if (!empty($model['creator']['photoprofil']) and $model['creator']['photoprofil']!=NULL){?> <img id="ava" src="<?php echo $model['creator']['photoprofil'];?>" alt="avatar"> <?php }?></div>
  </li>
  <li>
    <h3><?php echo $model['creator']['nickname']?></h3>
  </li>

  <li>
    <div class="bouton">
      <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $model['id_evenement']?>">Voir la page de l'évenement</a>
    </div>
  </li>
  <!--insérer note de l'auteur-->
</ul>
</div>
