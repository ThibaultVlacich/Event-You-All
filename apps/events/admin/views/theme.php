<h2 class="title">Liste des Themes</h2>
<table class="table">
  <thead>
    <tr>
      <th>#ID</th>
      <th>Nom</th>
      <th>Affiché</th>
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
        <?php if ($value['afficher']==1){ echo 'oui';}else{echo 'non';}?>
      </td>
      <td>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/modiftheme/<?php echo $value['id']; ?>" title="Modifier le thème"><i class="fa fa-edit fa-lg"></i></a>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/<?php if ($value['afficher']==0) {echo 'changetheme';} else { echo 'changethemeno';}?>/<?php echo $value['id']; ?>" title="Afficher ou non le thème"><i class="fa fa-trash fa-lg"></i></a>
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

<a href="<?php echo Config::get('config.base'); ?>/admin/events/ajoutheme">Ajouter un thème</a>
