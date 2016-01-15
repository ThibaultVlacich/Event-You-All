<?php
  if (empty($model)) {
    // No event based on asked id
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
    <li>Le thème demandé n'existe pas !</li>
  </ul>
</div>
<?php
    return;
  }
?>
<div class="app-events app-events-create">
  <h1 class="app-title">Modifier le Thème (Admin)</h1>
  <form method="post" action="<?php echo Config::get('config.base'); ?>/admin/events/modif_confirm_theme/<?php echo $model['id'];?>" enctype="multipart/form-data">
    <div class="form-main">
      <div class="form-block full">
        <h3 class="form-block-title">&Agrave; propos du Thème</h3>
        <div class="form-group full">
          <label for="nom">Nom <span class="required">*</span></label>
          <input type="text" name="nom" id="nom" required value="<?php echo $model['nom']; ?>">
        </div>
        </div>
        </div>
    <aside class="form-column">
      <div class="form-block sticky">
        <h3 class="form-block-title">Valider</h3>
        <p><span class="required">*</span> : champ obligatoire</p>
        <input type="submit" value="Envoyer">
        <input type="button" onclick="history.back()" value="Annuler">
      </div>
    </aside>
  </form>
</div>
