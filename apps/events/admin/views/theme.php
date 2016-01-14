<h1 class="app-title">Liste des Themes</h1>
<div class="app-actions">
  <a href="<?php echo Config::get('config.base'); ?>/admin/events/addtheme">Ajouter un thème</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th>#ID</th>
      <th>Nom</th>
      <th>Affiché</th>
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
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/hidetheme/<?php echo $value['id']; ?>" title="Masquer le theme"><i class="fa fa-eye-slash fa-lg"></i></a>
        <?php } else { ?>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/showtheme/<?php echo $value['id']; ?>" title="Afficher le theme"><i class="fa fa-eye fa-lg"></i></a>
        <?php } ?>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/modiftheme/<?php echo $value['id']; ?>" title="Modifier le thème"><i class="fa fa-edit fa-lg"></i></a>
      </td>
    </tr>
    <?php
    }

    if (empty($model)) {
      echo '<tr><td colspan="6" style="text-align: center;">Aucun theme n\'a encore été créé !</td></tr>';
    }
    ?>
  </tbody>
</table>
