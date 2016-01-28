<?php
if ($model == 0) {
?>
<div class="note error">
  <i class="fa fa-spin fa-spinner"></i>
  <script type="text/javascript">
    setTimeout(function() {
      window.location = '<?php echo Config::get('config.base'); ?>';
    }, 3000);
  </script>
  <ul>
    <li>Ceci n'est pas votre événement !</li>
    <li>Vous allez être redirigé dans 3 secondes.</li>
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
      window.location = '<?php echo Config::get('config.base'); ?>';
    }, 3000);
  </script>
  <ul>
    <li>Votre événement a été supprimé avec succès !</li>
    <li>Vous allez être redirigé dans 3 secondes.</li>
  </ul>
</div>
