<div class="app-contact">
  <h2>Contact</h2>
  <div class="form">
    <?php
      if (isset($model['success']) && $model['success'] === true) {
    ?>
    <div class="success">
      <i class="fa fa-spin fa-spinner"></i>
      <ul>
        <li>Bienvenue <strong><?php echo $model['data']['nickname']; ?></strong>. Votre compte a été créé avec succès !</li>
        <li>Vous allez être redirigé dans 5 secondes.</li>
      </ul>
    </div>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>';
      }, 5000);
    </script>
    <?php
        return;
      }

      if (!empty($model['errors'])) {
    ?>
    <div class="error">
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
    <form id="register" method="post" action="<?php echo Config::get("config.base"); ?>/user/register">
      <div>
        <label for="nickname">Pseudonyme <span class="required">*</span></label> <input type="text" name="nickname" id="nickname" required />
        <label for="lastname">Nom <span class="required">*</span></label> <input type="text" name="lastname" id="lastname" required />
        <label for="firstname">Prénom <span class="required">*</span></label> <input type="text" name="firstname" id="firstname" required />
        <label for="email">Adresse e-mail <span class="required">*</span></label> <input type="email" name="email" id="email" required />
        <label for="password">Mot de passe <span class="required">*</span></label> <input type="password" name="password" id="password" required />
        <label for="password_confirm">Confirmation mot de passe <span class="required">*</span></label> <input type="password" name="password_confirm" id="password_confirm" required />
        <label for="adress">Adresse</label> <input type="text" name="adress" id="adress" />
        <label for="zip_code">Code postal</label> <input type="text" name="zip_code" id="zip_code" maxlength="5" />
        <label for="city">Ville</label> <input type="text" name="city" id="city" />
        <label for="country">Pays</label>
        <select name="country" id="country" >
          <option value="FR">France</option>
          <option value="CN">Canada</option>
        </select>
        <label for="phone">Telephone</label><input type="text" name="phone" id="phone" />
        <div class="checkbox">
          <input type="checkbox" name="newsletter" id="newsletter" checked />
          <label for="newsletter">J'accepte de recevoir les newsletters par mail</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" name="cgu" id="cgu" required />
          <label for="cgu">J'accepte les conditions d'utilisation du site <span class="required">*</span></label>
        </div>
        <p>* : champs obligatoires</p>

        <input type="submit" value="S'inscrire" class="submit" id="submit" />
      </div>
    </form>
  </div>
</div>
