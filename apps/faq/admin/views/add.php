<h1 class="app-title">Nouvelle question/réponse</h1>
<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/faq/confirmAdd">
  <section class="QWadd">
    <p class="reponsemodif">Question</p>
    <input type="text" id="text_modifyQ" name="text_modifyQ" />
    <p class="reponsemodif">Réponse</p>
    <textarea id="text_modifyR" name="text_modifyR"> </textarea>
    <input type="submit" value="Ajouter" class="add" id="add" />
  </section>
</form>
