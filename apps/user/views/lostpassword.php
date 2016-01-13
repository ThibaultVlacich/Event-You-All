<div class="app-user app-user-passwordlost">
  <?php $session = System::getSession(); if ($session->isConnected()){ ?>
    <div class="note error">
      <i class="fa fa-exclamation-triangle"></i>
      <ul><li>Vous êtes connecté, vous ne pouvez pas demander de nouveau mot de passe ! Déconnectez-vous ou changez votre mot de passe en <a href='<?php echo Config::get('config.base'); ?>/user/updatepassword'>cliquez ici</a></li>
      </ul>
    </div>
    <?php } else{ ?>
  <h2>Mot de passe oublié</h2>
  <div class="form">
    <?php
      if (isset($model['success']) && $model['success'] === true) {
    ?>
    <div class="note success">
      <i class="fa fa-check"></i>
      <ul>
        <li>Un nouveau mot de passe vous a été envoyé par email !</li>
        <li><a href="<?php echo Config::get('config.base'); ?>">Retourner à la page de connexion</a></li>
      </ul>
    </div>
    <?php
        return;
      }

      if (!empty($model['errors'])) {
    ?>
    <div class="note error">
      <i class="fa fa-exclamation-triangle"></i>
      <ul>
      <?php
        foreach ($model['errors'] as $error) {
          echo '<li>'.$error.'</li>';
        }
      ?>
      </ul>
    </div>
    <?php } ?>
    <p>
      Pour recevoir un nouveau mot de passe, veuillez saisir votre adresse email dans le formulaire ci-dessous.
    </p>
    <form method="post" action="<?php echo Config::get('config.base'); ?>/user/passwordlost">
      <div>
        <label for="email">Email</label><input name="email" id="email" type="text" required /><br/>
        <input type="submit" value="Recevoir un nouveau mot de passe" class="submit" />
      </div>
    </form>
  </div>
  <?php } ?>
</div>
