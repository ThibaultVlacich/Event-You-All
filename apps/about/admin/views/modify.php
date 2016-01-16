<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/about/modifyConfirm">
<div>
  <textarea id="text_modify" name="text_modify"><?php echo $model['about'] ?></textarea>

</div>
<input type="submit" value="Modifier" class="modify" id="modify" />
</form>
