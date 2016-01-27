<div class="app-user app-user-passwordlost">
  <h2>Modifier mon Mot de Passe</h2>
  <div class="form">
    <?php
      if (isset($model['success']) && $model['success'] === true) {
    ?>
    <div class="note success">
      <i class="fa fa-check"></i>
      <ul>
        <li>Votre nouveau mot de passe a bien été mis à jour !</li>
        <li><a href="<?php echo Config::get('config.base'); ?>/user/myprofil">Retourner sur mon profil</a></li>
      </ul>
    </div>
    <?php
        return;
      }

      if(isset($model['success']) && $model['success'] === false) {
    ?>
    <div class="note error">
      <i class="fa fa-exclamation-triangle"></i>
      <ul>
      <?php
          echo '<li>'.$model['error'].'</li>';
      ?>
      </ul>
    </div>
    <?php } else if($model['success'] == 'pasencore') { ?>
    <p>
      Pour modifier votre mot de passe, veuillez remplir le formulaire ci-dessous.
    </p>
    <?php } ?>
    <form method="post" action="<?php echo Config::get('config.base'); ?>/user/updatepassword">
      <div>
        <label for="oldpassword">Ancien mot de passe</label><input name="oldpassword" id="oldpassword" type="password" required /><br/>
        <label for="newpassword">Nouveau mot de Passe</label><input name="newpassword" id="newpassword" type="password" required /><br/>
        <label for="newpasswordcheck">Confirmation</label><input name="newpasswordcheck" id="newpasswordcheck" type="password" required /><br/>
        <input type="submit" value="Mettre à jour mon mot de Passe" class="submit" />
      </div>
    </form>
  </div>
</div>
