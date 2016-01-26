<h1 class="app-title">Questions fréquentes</h1>
<?php  foreach($model as $qw) { ?>
<section class="QW">
  <p class="question"> <?php echo $qw['question']; ?></p>
  <p class="reponse"><?php echo $qw['reponse']; ?></p>
  <a class="modifybutton" href="<?php echo Config::get('config.base'); ?>/admin/faq/modify/<?php echo $qw['id'];?>">Modifier</a>
  <a class="deletebutton" href="<?php echo Config::get('config.base'); ?>/admin/faq/delete/<?php echo $qw['id'];?>">Supprimer</a>
</section>
<?php } ?>
<div class="app-actions">
  <a href="<?php echo Config::get('config.base'); ?>/admin/faq/add">Ajouter une nouvelle question/réponse</a>
</div>
