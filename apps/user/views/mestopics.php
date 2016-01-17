
<h1 id="page">Mon Compte</h1>
<a href='<?php echo Config::get('config.base'); ?>/user/myprofil' class='boutoncompte'>Retourner sur mon profil</a>
<a href='<?php echo Config::get('config.base'); ?>/forum' class='boutoncompte'>Accès au Forum</a>
<h2  class='voirmestopics'>Les Topics que j'ai créé</h2>
<table>
      <tr class="topic">
        <th>Titre</th>
        <th>Description</th>
        <th>Date de création</th>
      </tr>
        <?php $i=1; ?>
        <?php foreach($model['topicscreation'] as $topic) { ?>
          <tr class=<?php if ($i%2==0){echo"detailtopic1" ;} else{echo "detailtopic2"; } ?>>
          <th class="titre">
              <a href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $topic['id']; ?>"><?php echo $topic['titre']; ?></a>
          </th>
          <th class="description">
              <a href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $topic['id']; ?>"><?php echo substr(strip_tags ($topic['description']), 0, 500); ?></a>
          </th>
          <th class="date">
              <a href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $topic['id']; ?>"><?php echo $topic['date_creation']; ?></a>
          </th>
          </tr>
                  <?php   $i=$i+1; } ?>
</table>
