<div class="app-events app-events-create">
  <h1 class="app-title">Ajouter un Type (Admin)</h1>
  <form method="post" action="<?php echo Config::get('config.base'); ?>/admin/events/add_confirm_type" enctype="multipart/form-data">
    <div class="form-main">
      <div class="form-block full">
        <h3 class="form-block-title">&Agrave; propos du Type</h3>
        <div class="form-group full">
          <label for="nom">Nom <span class="required">*</span></label>
          <input type="text" name="nom" id="nom" required>
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
