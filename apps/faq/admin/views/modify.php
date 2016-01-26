<h1 class="app-title">Modifier une question/réponse</h1>
<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/faq/modifyConfirm/<?php echo $model['id'];?>">
  <div>
    <section class="QW">
      <p class="questionmodif">Question</p>
      <input id="text_modifyQ" name="text_modifyQ" value="<?php echo $model['question']; ?>" />
      <p class="reponsemodif">Reponse</p>
      <textarea id="text_modifyR" name="text_modifyR"><?php echo $model['reponse']; ?></textarea>
    </section>
    <input type="submit" value="Modifier" class="modify" id="modify" />
  </div>
</form>
