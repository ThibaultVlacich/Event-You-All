
<div class="text"><?php
echo $model['faq'];
?>
</div>
<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/faq/modify">
<input type="submit" value="Modifier" class="modify" id="modify" />
</form>
