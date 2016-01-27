<div class="app-article app-article-all">
  <h2 class="title">Derniers articles publiés</h2>
  <?php
    foreach($model['articles'] as $art) {
  ?>
  <div class="article">
    <a class="link" href="<?php echo Config::get('config.base'); ?>/article/detail/<?php echo $art['id']; ?>"><?php echo $art['nom'];?></a>
    <br>
    <em>Article publié par <strong><?php echo $art['author']['nickname']; ?></strong> sur l'événement <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $art['event']['id']; ?>"><?php echo $art['event']['nom']; ?></a></em>
    <p>
      <?php echo substr($art['contenu'], 0, 500) ; if (strlen($art['contenu']) > 500){ echo '...'; } ?>
    </p>
  </div>
  <?php } ?>
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
</div>
