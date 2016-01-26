<h1 class="app-title">Modifier la page "&Agrave; propos"</h1>
<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/about/modifyConfirm">
  <div>
    <textarea id="text_modify" name="text_modify"><?php echo $model['about'] ?></textarea>
  </div>
  <input type="submit" value="Modifier" class="modify" id="modify" />
</form>
