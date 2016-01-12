<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/faq/modifyConfirm">
<div>
  <textarea id="text_modify" name="text_modify"><?php echo $model['faq'] ?></textarea>

</div>

<input type="submit" value="Modifier" class="modify" id="modify" />
</form>
