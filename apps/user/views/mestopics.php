
<h1 id="page">Mon Compte</h1>
<a href='<?php echo Config::get('config.base'); ?>/user/myprofil' class='boutoncompte'>Retourner sur mon profil</a>
<a href='<?php echo Config::get('config.base'); ?>/forum' class='boutoncompte'>Accès au Forum</a>
<h2  class='voirmestopics'>Les Topics que j'ai créé</h2>
      <ul class="topic">
        <li>Titre</li>
        <li>Description</li>
        <li>Date de création</li>
      </ul>
        <?php $i=1; ?>
        <?php foreach($model['topicscreation'] as $topic) { ?>
        <div class="topicdiv">
          <ul class=<?php if ($i%2==0){echo"detailtopic1" ;} else{echo "detailtopic2"; } ?>>
          <li class="titre">
              <a href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $topic['id']; ?>"><?php echo $topic['titre']; ?></a>
          </li>
          <li class="description">
              <a href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $topic['id']; ?>"><?php echo $topic['description']; ?></a>
          </li>
          <li class="date">
              <a href="<?php echo Config::get('config.base'); ?>/forum/Topic/<?php echo $topic['id']; ?>"><?php echo $topic['date_creation']; ?></a>
          </li>
          </ul>
        </div>
        <?php   $i=$i+1; } ?>
