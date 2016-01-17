<div class="app-user app-user-admin app-user-admin-index">
  <h1 class="app-title">Liste des utilisateurs</h1>
  <table class="table">
    <thead>
      <tr>
        <th>#ID</th>
        <th>Pseudonyme</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date d'inscription</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($model['users'] as $user) { ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['nickname']; ?></td>
        <td><?php echo $user['firstname']; ?></td>
        <td><?php echo $user['lastname']; ?></td>
        <td><?php echo $user['register_date']; ?></td>
        <td>
          <a href="<?php echo Config::get('config.base'); ?>/admin/user/modify/<?php echo $user['id']; ?>" title="Modifier l'utilisateur"><i class="fa fa-edit fa-lg"></i></a>
          <a href="<?php echo Config::get('config.base'); ?>/admin/user/delete/<?php echo $user['id']; ?>" title="Supprimer l'utilisateur"><i class="fa fa-trash fa-lg"></i></a>
        </td>
      </tr>
      <?php } ?>
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
      <li><a href="<?php echo Config::get('config.base'); ?>/admin/user/page/<?php echo $n; ?>"><?php echo $n; ?></a></li>
      <?php
          }
        }
      ?>
  </ul>
</div>
