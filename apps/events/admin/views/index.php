<h1 class="app-title">Liste des événements</h1>
<div class="app-actions">
  <a href="<?php echo Config::get('config.base'); ?>/admin/events/themes">Gérer les thèmes</a>
  <a href="<?php echo Config::get('config.base'); ?>/admin/events/types">Gérer les types</a>
  <a href="<?php echo Config::get('config.base'); ?>/admin/events/regions">Gérer les régions</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th>#ID</th>
      <th>Nom</th>
      <th>Créateur</th>
      <th>Theme</th>
      <th>Type</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($model['events'] as $value) { ?>
    <tr>
      <td>
        <?php echo $value['id'];?>
      </td>
      <td>
        <?php echo $value['nom'];?>
      </td>
      <td>
        <?php echo $value['createur']['nickname'];?>
      </td>
      <td>
        <?php echo $value['theme']['nom'];?>
      </td>
      <td>
        <?php echo $value['type']['nom'];?>
      </td>
      <td>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/modif/<?php echo $value['id']; ?>" title="Modifier l'événement"><i class="fa fa-edit fa-lg"></i></a>
        <a href="<?php echo Config::get('config.base'); ?>/admin/events/delete/<?php echo $value['id']; ?>" title="Supprimer l'événement" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet événement ?'));"><i class="fa fa-trash fa-lg"></i></a>
      </td>
    </tr>
    <?php
    }

    if (empty($model['events'])) {
      echo '<tr><td colspan="6" style="text-align: center;">Aucun événement n\'a encore été créé !</td></tr>';
    }
    ?>
  </tbody>
</table>
<?php
  // Pagination
  $numberOfPages = ceil($model['total'] / $model['per_page']);
?>
<ul class="num_page">
    <?php
      for($n = 1; $n <= $numberOfPages; $n++) {
        if ($n == $model['current_page']) {
    ?>
    <li class="current"><?php echo $n; ?></li>
    <?php
        } else {
    ?>
    <li><a href="<?php echo Config::get('config.base'); ?>/admin/events/page/<?php echo $n; ?>"><?php echo $n; ?></a></li>
    <?php
        }
      }
    ?>
</ul>
