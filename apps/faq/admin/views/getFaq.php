<h2> FAQ
</h2>


<div class="text">
  <?php  foreach($model as $qw) { ?>
  <section class="QW">
      <p class="question"> <?php echo $qw['question']; ?></p>
      <p class="reponse"><?php echo $qw['reponse']; ?></p>
  </section>


<?php } ?>
</div>
<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/faq/modify">
<input type="submit" value="Modifier" class="modify" id="modify" />
</form>
