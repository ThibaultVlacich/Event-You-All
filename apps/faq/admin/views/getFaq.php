<h2> FAQ
</h2>


<div class="text">
  <?php  foreach($model as $qw) { ?>
  <section class="QW">
      <p class="question"> <?php echo $qw['question']; ?></p>
      <p class="reponse"><?php echo $qw['reponse']; ?></p>
      <a href="<?php echo Config::get('config.base'); ?>/admin/faq/modify/<?php echo $qw['id'];?>">Modifier</a>
      <a href="<?php echo Config::get('config.base'); ?>/admin/faq/delete/<?php echo $qw['id'];?>">Supprimer</a>
  </section>


<?php } ?>
<a href="<?php echo Config::get('config.base'); ?>/admin/faq/add">Ajouter</a>

</div>
