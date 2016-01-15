<h1 class="app-title">Liste des Régions</h1>
<div class="app-actions">
  <a href="<?php echo Config::get('config.base'); ?>/admin/events/addregion">Ajouter une région</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th>#ID</th>
      <th>Nom</th>
      <th>Affichée</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($model as $value) { ?>
    <tr>
      <td>
        <?php echo $value['id'];?>
      </td>
      <td>
        <?php echo $value['nom'];?>
      </td>
      <td>
        <?php echo ($value['afficher'] == 1) ? 'Oui' : 'Non'; ?>
      </td>
      <td>
        <?php if ($value['afficher'] == 1) { ?>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/hideregion/<?php echo $value['id']; ?>" title="Masquer la région"><i class="fa fa-eye-slash fa-lg"></i></a>
        <?php } else { ?>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/showregion/<?php echo $value['id']; ?>" title="Afficher la région"><i class="fa fa-eye fa-lg"></i></a>
        <?php } ?>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/modifregion/<?php echo $value['id']; ?>" title="Modifier la Région"><i class="fa fa-edit fa-lg"></i></a>
      </td>
    </tr>
    <?php
    }

    if (empty($model)) {
      echo '<tr><td colspan="4" style="text-align: center;">Aucune Région n\'a encore été créé !</td></tr>';
    }
    ?>
  </tbody>
</table>
