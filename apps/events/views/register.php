<?php
if($model === false) {
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

if(isset($model['success']) && $model['success']) {
  // The user has been registered to the event with success
?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $model['id_event']; ?>';
      }, 3000);
    </script>
    <ul>
        <li>Vous avez été inscrit à l'événement <em><?php echo $model['event']['nom']; ?></em>" !</li>
        <li>Vous allez être redirigé dans 3 secondes.</li>
    </ul>
</div>
<?php
  return;
}

if(isset($model['already_registered'])) {
  // The user has already registered to this event
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
    <li>Vous êtes déjà inscrit à cet événement !</li>
    <li><a href="#" onclick="history.back();">Retourner à la page précédente</a></li>
  </ul>
</div>
<?php
  return;
}

// The user still need to confirm if he wants to register to the event
?>
<div class="note question">
    <i class="fa fa-question-circle"></i>
    <ul>
        <li>Voulez-vous vraiment vous inscrire à l'événement "<em><?php echo $model['event']['nom']; ?></em>" ?</li>
    </ul>
    <ul class="buttons">
      <li><a class="confirm" href="<?php echo Config::get('config.base'); ?>/events/register/<?php echo $model['id_event']; ?>/confirm">Oui</a></li>
      <li><a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $model['id_event']; ?>">Annuler</a></li>
    </ul>
</div>
