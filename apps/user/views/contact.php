<?php
if($model['success'] === false) {
  // The asked event doesn't exist
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
    <li>L'événement demandé n'existe pas !</li>
    <li><a href="#" onclick="history.back();">Retourner à la page précédente</a></li>
  </ul>
</div>
<?php
  return;
}

if(isset($model['success']) && $model['success'] === true) {
  // The email has been sent with success
?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/user/profile/<?php echo $model['user']['id']; ?>';
      }, 3000);
    </script>
    <ul>
        <li>Votre mail a bien été envoyé !</li>
        <li>Vous allez être redirigé dans 3 secondes.</li>
    </ul>
</div>
<?php
  return;
}

if(isset($model['not_register'])) {
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
    <li>Vous n'êtes pas connecté !</li>
    <li><a href="#" onclick="history.back();">Retourner à la page précédente</a></li>
  </ul>
</div>
<?php
  return;
}

?>
<div class="app-contact">
  <h2>Contacter le membre <?php echo $model['user']['nickname']; ?></h2>
  <div class="form">
      <form method="post" action="<?php echo Config::get('config.base'); ?>/user/contact/<?php echo $model['user']['id']; ?>">
      <div>
        <label for="subject" >Sujet <span class="required">*</span></label> <input type="text" name="subject" id="subject" required />
        <label for="message">Message <span class="required">*</span></label> <textarea name="message" id="message" required ></textarea>
        <p>* : champs obligatoires</p>
        <input type="submit" value="Envoyer" class="sent" id="sent" />
      </div>
    </form>
  </div>
</div>
