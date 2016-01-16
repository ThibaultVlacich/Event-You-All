<div class="text"><?php
echo $model['about'];
?>
</div>
<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/about/modify">
<input type="submit" value="Modifier" class="modify" id="modify" />
</form>
