<?php

if (!empty($model['error'])) {
    echo('Erreur : ');
    print_r($model['error']);
return;
}
?>
<?php echo $model['id']; ?>
<div class="note success">
	<i class="fa fa-spin fa-spinner"></i>
	<script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>/article/detail/<?php echo $model['id']; ?>';
      }, 3000);
    </script>
	<ul>
		<li>Votre événement a été créé avec succès !</li>
		<li>Vous allez être redirigé dans 3 secondes.</li>
	</ul>
</div>
