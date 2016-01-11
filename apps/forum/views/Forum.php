        <ul id="haut">
            <a class="titreenteteforum" href="<?php echo Config::get('config.base'); ?>/forum/create"><li class="enteteforum">Créer un nouveau Topic</li></a>
            <a href="<?php echo Config::get('config.base'); ?>/user/mestopics" class="titreenteteforum"><li class="enteteforum">Mes Topics</li></a>    
        </ul>
        <table id="forum">
            <thead id="label">
                <tr class="titresujet">
                    <th class="sujet">Titre</th>
                    <th class="description">Description</th>
                    <th class="admin">Administrateur</th>
                    <th class="date">Date de création</th>
                </tr>
            </thead>
            <?php foreach($model['topics'] as $topic) { ?>
            <tr>
                <td class="sujet"><a class="link_topic" href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $topic['id']; ?>"><?php echo $topic['titre']; ?></a></td>
                <td class="description"><?php echo $topic['description']; ?></td>
                <td class="admin"><a class="link_topic" href="<?php echo Config::get('config.base'); ?>/user/profile/<?php echo $topic['createur']['id'];?>"><?php echo $topic['createur']['nickname'];?></a></td>
                <td class="date"><?php echo $topic['date_creation'];?></td>
                <td class="acceder"><a class="acceder" href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo  $topic['id']; ?>">Accéder</a></td>
            </tr>
            <?php } ?>
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
              <td><a href="<?php echo Config::get('config.base'); ?>/forum/page/<?php echo $n; ?>"><?php echo $n; ?></a></td>
              <?php
                  }
                }
              ?>
            </tr>
        </table>
