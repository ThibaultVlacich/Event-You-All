<h2 class="title">Liste des articles</h2>
<table class="table">
  <thead>
    <tr>
      <th>#ID</th>
      <th>Création</th>
      <th>Nom</th>
      <th>Créateur</th>
      <th>Evenement lié</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($model['articles'] as $value) { ?>
    <tr>
      <td>
        <?php echo $value['id']; ?>
      </td>
      <td>
        <?php echo $value['date_creation'];?>
      </td>
      <td>
        <?php echo $value['nom'];?>
      </td>
      <td>
        <?php echo $value['createur']['nickname'];?>
      </td>
      <td>
        <?php echo $value['evenement']['nom'];?>
      </td>
      <td>
        <a href="<?php echo Config::get('config.base'); ?>/admin/article/modif/<?php echo $value['id']; ?>" title="Modifier l'article"><i class="fa fa-edit fa-lg"></i></a>
        <a href="<?php echo Config::get('config.base'); ?>/admin/article/delete/<?php echo $value['id']; ?>" title="Supprimer l'article" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet article ?'));"><i class="fa fa-trash fa-lg"></i></a>
      </td>
    </tr>
  <?php
  }

  if (empty($model['articles'])) {
    echo '<tr><td colspan="6" style="text-align: center;">Aucun article n\'a encore été créé !</td></tr>';
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
    <li><a href="<?php echo Config::get('config.base'); ?>/admin/article/page/<?php echo $n; ?>"><?php echo $n; ?></a></li>
    <?php
        }
      }
    ?>
</ul>
