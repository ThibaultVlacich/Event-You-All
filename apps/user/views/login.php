<div class="app-user app-user-login">
  <h2>Connexion</h2>
  <div class="login-form">
    <form id="Connexion" method="post" action="<?php Config::get('config.base'); ?>/user/login">
      <div>
        <label for="email">Email</label><input name="email" id="email" type="text" required /><br/>
        <label for="password">Mot de Passe</label><input id="password" type="password" required /><br/>
        <input type="submit" value="Se Connecter" class="submit" />
      </div>
    </form>
    <div class="links">
      <a href="Pagemotdepasseoublié" class="password-lost">Mot de passe oublié</a>
      <a href="Pagepasencoreinscrit" class="register">Pas encore inscrit ?</a>
      <div class="clearer"></div>
    </div>
  </div>
</div>
