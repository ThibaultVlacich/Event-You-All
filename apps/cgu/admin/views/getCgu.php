<div class="text"><?php
echo $model['cgu'];
?>
</div>
<form method="post" action="<?php echo Config::get('config.base'); ?>/admin/cgu/modify">
<input type="submit" value="Modifier" class="modify" id="modify" />
</form>
