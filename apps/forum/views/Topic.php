<ul id="haut">
    <a href="<?php echo Config::get('config.base'); ?>/forum" class="titreenteteforum"><li class="enteteforum">Revenir au Forum</li></a>
    <a class="titreenteteforum" href="<?php echo Config::get('config.base'); ?>/forum/create"><li class="enteteforum">Créer un nouveau Topic</li></a>
    <a href="<?php echo Config::get('config.base'); ?>/user/mestopics" class="titreenteteforum"><li class="enteteforum">Mes Topics</li></a>
</ul>
        <?php
          if (empty($model)) {
            // No topic based on asked id
        ?>
        <div class="note error">
          <i class="fa fa-exclamation-triangle"></i>
          <ul>
            <li>Le sujet demandé n'existe pas !</li>
          </ul>
        </div>
        <?php
            return;
          }
        ?>
        <?php if($_SESSION['access']>=2){?>
          <a class="admin" href="<?php echo Config::get('config.base'); ?>/forum/delete/<?php echo $model['id_topic']; ?>">supprimer ce topic</a>
          <?php } ?>
        <img src="<?php echo $model['photoprofil']['photoprofil']; ?>" class="avatartopic"/>
        <ul id="presentation">
            <li><p>Sujet de :</p></li>
            <li><h3><?php echo $model['createurtop']; ?></h3></li>
            <li><p>Crée le :</p></li>
            <li><h3><?php echo $model['date_creation']; ?></h3></li>
        </ul>
        <ul id="titre">
            <li><p>Sujet :</p></li>
            <li><div><h1><?php echo $model['titre']; ?></h1></div></li>
        </ul>
        <ul id="description">
            <li><p>Description :</p></li>
            <li><div><h3><?php echo $model['description']; ?></h3></div></li>
        </ul>
        <table class="messages">
          <thead class="first_ligne">
            <tr>
              <?php if($_SESSION['access']>=2){?>
              <td class="suppressbutton">
              </td>
              <?php } ?>
              <td class="image">
                <h4>Avatar</h4>
              </td>
                <td class="utilisateur">
                    <h4>Utilisateur</h4>
                </td>
                <td class="com">
                    <h4 class="p_commentaire">Commentaire</h4>
                </td>
                <td class="date">
                    <h4>Date</h4>
                </td>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; ?>
            <?php foreach($model['comments'] as $comment) {?>
            <tr class="back<?php echo (!$i%2) ? '1' : '2'; ?>">
              <?php if($_SESSION['access']>=2){?>
                <td class="suppressbutton"><a href="<?php echo Config::get('config.base'); ?>/forum/deleteComment/<?php echo $comment['id']; ?>">supprimer</a></td>
                <?php } ?>
                <td class="image">
                  <img src="<?php echo $comment['photoprofil']['photoprofil']; ?>" class="avatar"/>
                </td>
                <td class="utilisateur">
                    <h4><?php echo $comment['createur']['nickname']; ?></h4>
                </td>
                <td class="com">
                    <p class="p_commentaire"><?php echo $comment['message']; ?></p>
                </td>
                <td class="date">
                    <p><?php echo $comment['date']; ?></p>
                </td>
            </tr>
            <?php $i=$i+1; } ?>
          </tbody>
        </table>
        <?php
          // Pagination
          $numberOfPages = ceil($model['total'] / $model['per_page']);
        ?>
        <table id="num_page">
            <tr>
              <?php
                for($n = 1; $n <= $numberOfPages; $n++) {
                  if ($n == $model['current_page']) {
              ?>
              <td><?php echo $n; ?></td>
              <?php
                  } else {
              ?>
              <td><a href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $model['id_topic'] ?>/page/<?php echo $n; ?>"><?php echo $n; ?></a></td>
              <?php
                  }
                }
              ?>
            </tr>
        </table>

<form method="post" action="<?php echo Config::get('config.base'); ?>/forum/send_comment/<?php echo $model['id_topic']?>">
          <h3 id="aj_com">Ajouter un commentaire :</h3>
          <textarea required name='message' id="commentaire"></textarea><br/>
        <input class="Envoyer" type="submit" value="Envoyer">
</form>
