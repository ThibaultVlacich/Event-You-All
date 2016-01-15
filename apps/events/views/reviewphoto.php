<?php
if(isset($model['errors']) && !empty($model['errors'])) {
  // There is errors
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
    <?php foreach ($model['errors'] as $error) { ?>
    <li><?php echo $error; ?></li>
    <?php } ?>
    <li><a href="#" onclick="history.back();">Retourner à la page précédente</a></li>
  </ul>
</div>
<?php
  return;
}

if(isset($model['success']) && $model['success']) {
?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $model['photo']['id_evenement']; ?>';
      }, 3000);
    </script>
    <ul>
        <li>La photo a été <?php echo (isset($data['deleted']) && $data['deleted']) ? 'supprimée' : 'validée'; ?> avec succès !</li>
        <li>Vous allez être redirigé dans 3 secondes.</li>
    </ul>
</div>
<?php
  return;
}

?>
<div class="note question">
    <i class="fa fa-question-circle"></i>
    <ul>
        <li>Voulez-vous ajouter la photo "<em><?php echo $model['photo']['nom']; ?></em>" à votre événement ?</li>
    </ul>
    <img src="<?php echo $model['photo']['url']; ?>" alt="" style="max-width: 100%; margin-top: 20px;" />
    <ul class="buttons">
      <li><a class="confirm" href="<?php echo Config::get('config.base'); ?>/events/reviewphoto/<?php echo $model['photo']['id']; ?>/confirm">Oui</a></li>
      <li><a class="danger" href="<?php echo Config::get('config.base'); ?>/events/reviewphoto/<?php echo $model['photo']['id']; ?>/delete">Supprimer</a></li>
    </ul>
</div>
