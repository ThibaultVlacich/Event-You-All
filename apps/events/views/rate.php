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
  // The user has rated the event with success
?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $model['id_event']; ?>';
      }, 3000);
    </script>
    <ul>
        <li>Vous avez bien noté la note de <strong><?php echo $model['note']; ?></strong> à l'evénement "<em><?php echo $model['event']['nom']; ?></em>" !</li>
        <li>Vous allez être redirigé dans 3 secondes.</li>
    </ul>
</div>
<?php
  return;
}

if(isset($model['already_rated'])) {
  // The user has already rated this event
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
    <li>Vous avez déjà donné une note à cet événement !</li>
    <li><a href="#" onclick="history.back();">Retourner à la page précédente</a></li>
  </ul>
</div>
<?php
  return;
}

// The user still need to confirm his note
?>
<div class="note question">
    <i class="fa fa-question-circle"></i>
    <ul>
        <li>Voulez-vous vraiment donner la note de <strong><?php echo $model['note']; ?></strong> à l'événement "<em><?php echo $model['event']['nom']; ?></em>"&nbsp;?</li>
    </ul>
    <ul class="buttons">
      <li><a class="confirm" href="<?php echo Config::get('config.base'); ?>/events/rate/<?php echo $model['id_event']; ?>/confirm?note=<?php echo intval($model['note']); ?>">Oui</a></li>
      <li><a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $model['id_event']; ?>">Annuler</a></li>
    </ul>
</div>
