<?php
if (!empty($model['error'])) {
  ?>
  <div class="note error">
    <i class="fa fa-exclamation-triangle"></i>
    <ul>
    <?php
      foreach ($model['error'] as $error) {
        echo '<li>'.$error.'</li>';
      }
    ?>
      <li><a href="#" onclick="history.back(); return false;">Retourner à la page précédente</a></li>
    </ul>
  </div>
  <?php
return;
}

?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/admin/events';
      }, 2000);
    </script>
    <ul>
        <li>Votre événement a été modifié avec succès !</li>
        <li>Vous allez être redirigé dans 2 secondes.</li>
    </ul>
</div>
