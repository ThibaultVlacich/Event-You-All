<div class="app-user app-user-login">
  <h2>Connexion</h2>
  <div class="form">
    <?php
      if (!empty($model['errors'])) {
    ?>
    <div class="errors">
      <i class="fa fa-exclamation-triangle"></i>
      <ul>
      <?php
        foreach ($model['errors'] as $error) {
          echo '<li>'.$error.'</li>';
        }
      ?>
      </ul>
    </div>
    <?php
      }
    ?>
    <form id="Connexion" method="post" action="<?php echo Config::get('config.base'); ?>/user/login">
      <div>
        <label for="email">Email</label><input name="email" id="email" type="text" required /><br/>
        <label for="password">Mot de passe</label><input name="password" id="password" type="password" required /><br/>
        <input type="submit" value="Se connecter" class="submit" />
      </div>
    </form>
    <div class="links">
      <a href="<?php echo Config::get('config.base'); ?>/user/passwordlost" class="password-lost">Mot de passe oublié</a>
      <a href="<?php echo Config::get('config.base'); ?>/user/register" class="register">Pas encore inscrit ?</a>
    </div>
  </div>
</div>
