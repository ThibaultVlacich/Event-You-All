<div class="app-user app-user-login">
  <h2>Connexion</h2>
  <div class="form">
    <?php
      if (isset($model['success']) && $model['success'] === true) {
    ?>
    <div class="note success">
      <i class="fa fa-spin fa-spinner"></i>
      <ul>
        <li>Vous avez été connecté avec succès !</li>
        <li>Vous allez être redirigé dans 3 secondes.</li>
      </ul>
    </div>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo isset($model['redirect']) ? $model['redirect'] : Config::get('config.base'); ?>';
      }, 3000);
    </script>
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
    <?php
      }

      if (!in_array('Vous êtes déjà connecté !', $model['errors'])) {
    ?>
    <form id="Connexion" method="post" action="<?php echo Config::get('config.base'); ?>/user/login">
      <div>
        <label for="email">Email / Pseudonyme</label><input name="email" id="email" type="text" required /><br/>
        <label for="password">Mot de passe</label><input name="password" id="password" type="password" required /><br/>
        <input type="hidden" name="remember" value="remember" />
        <input type="submit" value="Se connecter" class="submit" />
      </div>
    </form>
    <div class="links">
      <a href="<?php echo Config::get('config.base'); ?>/user/passwordlost" class="password-lost">Mot de passe oublié</a>
      <a href="<?php echo Config::get('config.base'); ?>/user/register" class="register">Pas encore inscrit ?</a>
    </div>
    <?php } ?>
  </div>
</div>
