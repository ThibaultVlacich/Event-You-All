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

if(isset($model['success']) && $model['success']) {
  // The user has been deleted with success
?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/admin/user';
      }, 3000);
    </script>
    <ul>
        <li>L'utilisateur "<em><?php echo $model['user']['nickname']; ?></em>" a bien été supprimé !</li>
        <li>Vous allez être redirigé dans 3 secondes.</li>
    </ul>
</div>
<?php
  return;
}

// The admin still need to confirm the deletion of the user
?>
<div class="note question">
    <i class="fa fa-question-circle"></i>
    <ul>
        <li>Voulez-vous vraiment supprimer le membre "<em><?php echo $model['user']['nickname']; ?></em>" ?</li>
    </ul>
    <ul class="buttons">
      <li><a class="danger" href="<?php echo Config::get('config.base'); ?>/admin/user/delete/<?php echo $model['id_user']; ?>/confirm">Oui</a></li>
      <li><a href="<?php echo Config::get('config.base'); ?>/admin/user/<?php echo $model['id_event']; ?>">Annuler</a></li>
    </ul>
</div>
