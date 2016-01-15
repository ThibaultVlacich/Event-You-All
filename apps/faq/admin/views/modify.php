<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/faq/modifyConfirm/<?php echo $model['id'];?>">

  <div>


      <section class="QW">

          <p class="questionmodif"> Question</p>

          <textarea id="text_modifyQ" name="text_modifyQ"> <?php  echo $model['question']  ; ?></textarea>
          <p class="reponsemodif">Reponse</p>

          <textarea id="text_modifyR" name="text_modifyR"> <?php echo $model['reponse']; ?></textarea>
      </section>
<input type="submit" value="Modifier" class="modify" id="modify" />



  </div>



</form>
<!--
<form method="post" action="<?php //echo Config::get('config.base'); ?>/admin/faq/modifyAdd">
<section class="QWadd">
  <p class="reponsemodif">Nouvelle Question</p>
  <textarea id="text_modifyQ" name="text_modifyQ"></textarea>
  <p class="reponsemodif">Nouvelle Reponse</p>
  <textarea id="text_modifyR" name="text_modifyR"> </textarea>

<input type="submit" value="Ajouter" class="add" id="add" />
</form>
-->
