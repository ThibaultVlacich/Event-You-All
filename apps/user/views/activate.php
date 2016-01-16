<?php
  if (isset($model['success']) && $model['success'] === true) {
?>
<div class="note success">
  <i class="fa fa-spin fa-spinner"></i>
  <ul>
    <li>Votre compte a été activé avec succès ! Vous pouvez désormais vous connecter.</li>
    <li>Vous allez être redirigé dans 3 secondes.</li>
  </ul>
</div>
<script type="text/javascript">
  setTimeout(function() {
    window.location = '<?php echo Config::get('config.base').'/user/login'; ?>';
  }, 3000);
</script>
<?php
    return;
  }

  if (!empty($model['errors'])) {
?>
<div class="note error">
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
  return;
}
?>
