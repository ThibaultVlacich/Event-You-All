<div class="app-board app-board-admin">
  <h1 class="app-title">Tableau de bord de l'administration de Event-You-All !</h1>
  <ul class="modules">
    <li>
      <h2 class="title">Bienvenue sur l'administration du site Event-You-All&nbsp;!</h2>
      Veuillez sélectionner une application à administrer dans le menu de gauche.
    </li>
    <li>
      <h2 class="title">Statistiques du site</h2>
      <ul class="list">
        <li><strong><?php echo $model['userCount']; ?></strong>&nbsp;utilisateurs inscrits</li>
        <li><strong><?php echo $model['eventCount']; ?></strong>&nbsp;événements créés</li>
        <li><strong><?php echo $model['articleCount']; ?></strong>&nbsp;articles créés</li>
        <li><strong><?php echo $model['topicCount']; ?></strong>&nbsp;topics dans le forum</li>
        <li><strong><?php echo $model['messageCount']; ?></strong>&nbsp;messages dans le forum</li>
      </ul>
    </li>
    <li>
      <h2 class="title">Chat entre admins</h2>
      <ul class="chat">
      <?php foreach ($model['messages'] as $message) { ?>
        <li>
          <span><i class="fa fa-comment"></i> Par <strong><?php echo $message['author']['nickname']; ?></strong> le <?php echo $message['date']; ?> à <?php echo $message['heure']; ?></span>
          <p>
            <?php echo $message['text']; ?>
          </p>
        </li>
      <?php } ?>
      </ul>
      <form action="<?php echo Config::get('config.base'); ?>/admin/board/sendmessage" method="POST">
        <textarea name="message" placeholder="Envoyer un message"></textarea>
        <input type="submit" value="Envoyer">
      </form>
    </li>
  </ul>
</div>
