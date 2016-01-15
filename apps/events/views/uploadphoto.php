<?php
if (isset($model['errors']) && !empty($model['errors'])) {
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
  <?php
    foreach ($model['errors'] as $error) {
      echo '<li>'.$error.'</li>';
    }
  ?>
    <li><a href="#" onclick="history.back(); return false;">Retourner à la page précédente</a></li>
  </ul>
</div>
<?php
  return;
}

if (isset($model['success']) && $model['success']) {
?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $model['event']['id']; ?>';
      }, 3000);
    </script>
    <ul>
        <li>Votre photo a été téléchargée avec succès !</li>
        <?php if ($model['need_review']) { ?><li>Cependant, votre photo doit d'abord être validée par le créateur de l'événement avant d'être affichée</li><?php } ?>
        <li>Vous allez être redirigé dans 3 secondes.</li>
    </ul>
</div>
<?php
  return;
}
?>
<div class="app-events app-events-uploadphoto">
  <h2 class="title"></h2>
  <form method="post" action="<?php echo Config::get('config.base'); ?>/events/uploadphoto/<?php echo $model['event']['id']; ?>" enctype="multipart/form-data">
    <div class="form-main">
      <div class="form-block full">
        <h3 class="form-block-title">Télécharger une photo</h3>
        <div class="form-group full">
          <label>&Eacute;vénement</label>
          <input type="text" value="<?php echo $model['event']['nom']; ?>" disabled>
        </div>
        <div class="form-group full">
          <label for="title">Titre de la photo</label>
          <input type="text" name="title" id="title">
        </div>
        <div class="form-group full">
          <label for="photo">Photo</label>
          <input type="file" id="photo" name="photo">
          <em class="legend">Dimensions minimales : 640*360px. Dimensions maximales : 1280*720px.</em>
        </div>
      </div>
    </div>
    <aside class="form-column">
      <div class="form-block">
        <h3 class="form-block-title">Valider</h3>
        <input type="submit" value="Envoyer">
        <input type="button" onclick="history.back()" value="Annuler">
      </div>
    </aside>
  </form>
</div>
