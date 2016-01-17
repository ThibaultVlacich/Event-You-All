<?php
if($model === false) {
  // The asked user doesn't exist
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
    <li>L'utilisateur demandé n'existe pas !</li>
    <li><a href="#" onclick="history.back();">Retourner à la page précédente</a></li>
  </ul>
</div>
<?php
  return;
}

if ($model['method'] == 'POST' && empty($model['errors'])) {
?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/admin/user';
      }, 3000);
    </script>
    <ul>
        <li>L'utilisateur "<em><?php echo $model['user']['nickname']; ?></em>" a été modifié avec succès&nbsp;!</li>
        <li>Vous allez être redirigé dans 3 secondes.</li>
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
      <?php foreach ($model['errors'] as $error) { ?>
      <li><?php echo $error; ?></li>
      <?php } ?>
    </ul>
  </div>
<?php
}
?>
<div class="app-user app-user-admin app-user-admin-modify">
  <h1 class="app-title">Modifier un utilisateur</h1>
  <form method="post" action="<?php echo Config::get("config.base"); ?>/admin/user/modify/<?php echo $model['id_user']; ?>">
    <div>
      <label for="nickname">Pseudonyme (Ne peut être modifié)</label> <input type="text" name="nickname" id="nickname" value="<?php echo $model['user']['nickname']; ?>" disabled />
      <label for="access">Niveau d'accès</label>
      <select name="access" id="access">
        <option value="-1"<?php if($model['user']['access'] == -1) echo ' selected'; ?>>Banni</option>
        <option value="1"<?php if($model['user']['access'] == 1) echo ' selected'; ?>>Simple utilisateur</option>
        <option value="2"<?php if($model['user']['access'] == 2) echo ' selected'; ?>>Modérateur</option>
        <option value="3"<?php if($model['user']['access'] == 3) echo ' selected'; ?>>Administrateur</option>
      </select>
      <label for="lastname">Nom <span class="required">*</span></label> <input type="text" name="lastname" id="lastname" value="<?php echo $model['user']['lastname']; ?>" />
      <label for="firstname">Prénom <span class="required">*</span></label> <input type="text" name="firstname" id="firstname" value="<?php echo $model['user']['firstname']; ?>" />
      <label for="email">Adresse e-mail <span class="required">*</span></label> <input type="email" name="email" id="email" value="<?php echo $model['user']['email']; ?>" />
      <label for="password">Mot de passe (Modifier)</label> <input type="password" name="password" id="password" />
      <label for="password_confirm">Confirmation mot de passe (Modifier)</label> <input type="password" name="password_confirm" id="password_confirm" />

      <p>* : champs obligatoires</p>

      <input type="submit" value="Modifier l'utilisateur" class="submit" id="submit" />
    </div>
  </form>
</div>
