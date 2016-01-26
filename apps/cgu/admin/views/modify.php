<h1 class="app-title">Modifier les conditions générales d'utilisation</h1>
<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/cgu/modifyConfirm">
  <div>
    <textarea id="text_modify" name="text_modify"><?php echo $model['cgu'] ?></textarea>
  </div>
  <input type="submit" value="Modifier" class="modify" id="modify" />
</form>
