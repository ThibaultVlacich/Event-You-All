<?php
if (!empty($model['error'])) {
    echo('Erreur : ');
    print_r($model['error']);
return;
}

?>
<div class="note success">
    <i class="fa fa-spin fa-spinner"></i>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $model['id']; ?>';
      }, 3000);
    </script>
    <ul>
        <li>Votre Topic a été créé avec succès !</li>
        <li>Vous allez être redirigé dans 3 secondes.</li>
    </ul>
</div>
