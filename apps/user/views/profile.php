<div class="app-user-profile">
  <?php if ($model === false) { ?>
    <div class="note error">
      <i class="fa fa-exclamation-triangle"></i>
      <ul>
        <li>Le membre demandé n'existe pas !</li>
        <li><a href="#" onclick="window.history.back(); return false;">Retourner à la page précédente</a></li>
      </ul>
    </div>
  <?php return; } ?>
  <div class="profile-wrapper">
    <div class="profile-main">
      <section class="profile-detail-infos">
        <div class="avatar">
          <img src="<?php echo $model['user']['photoprofil']; ?>" alt="<?php echo $model['user']['nickname']; ?>" />
        </div>
        <div class="details">
          <h2 class="nom"><?php echo $model['user']['nickname']; ?></h2>
          <ul class="fa-ul">
            <?php if($model['user']['access'] >= 2) { ?>
            <li>
              <i class="fa fa-li fa-exclamation-circle"></i>
              Ce membre fait parti de l'équipe <strong>Event-You-All</strong>
            </li>
            <?php } ?>
            <li>
              <i class="fa fa-li fa-calendar-o"></i>
              Inscrit depuis le <?php echo $model['user']['register_date']; ?>
            </li>
            <?php if(!empty($model['user']['sex']) && $model['user']['sex'] != 'ns') { ?>
            <li>
              <i class="fa fa-li fa-venus-mars"></i>
              <?php echo ($model['user']['sex'] == 'm') ? 'Homme' : 'Femme'; ?>
            </li>
            <?php } ?>
            <?php if(isset($model['user']['age'])) { ?>
            <li>
              <i class="fa fa-li fa-birthday-cake"></i>
              <?php echo $model['user']['age']; ?>&nbsp;ans
            </li>
            <?php } ?>
            <?php if(isset($model['user']['region'])) { ?>
            <li>
              <i class="fa fa-li fa-home"></i>
              <?php echo $model['user']['region']['nom']; ?>
            </li>
            <?php } ?>
          </ul>
      </section>
      <?php if(!empty($model['eventscreated'])) { ?>
      <section class="profile-events">
        <h2 class="title">Les événements créés par <?php echo $model['user']['nickname']; ?></h2>
        <ul class="events">
          <?php foreach($model['eventscreated'] as $event) { ?>
            <li>
              <div class="poster">
                <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><img src="<?php echo $event['poster']; ?>" alt=""></a>
              </div>
              <div class="caption">
                <?php if(isset($event['theme'])) { ?>
                  <span class="theme"><?php echo $event['theme']['nom']; ?></span>
                <?php } ?>
                <?php if(isset($event['type'])) { ?>
                  <span class="theme"><?php echo $event['type']['nom'];?></span>
                <?php } ?>
                <h3><a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><?php echo $event['nom']; ?></a></h3>
                <?php
                  if((!empty($event['date_debut']) && empty($event['date_fin']) ) || ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] == $event['date_fin'])) {
                ?>
                <div class="date">Le <?php echo $event['date_debut']; ?></div>
                <?php
                  } else if(!empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] != $event['date_fin']) {
                ?>
                <div class="date">Du <?php echo $event['date_debut']; ?> au <?php echo $event['date_fin']; ?></div>
                <?php } ?>
              </div>
            </li>
         <?php } ?>
         </ul>
      </section>
      <?php } ?>
      <?php if(!empty($model['eventspasse'])) { ?>
      <section class="profile-events">
        <h2 class="title">Les événements auxquels <?php echo $model['user']['nickname']; ?> a participé</h2>
        <ul class="events">
          <?php foreach($model['eventspasse'] as $event) { ?>
            <li>
              <div class="poster">
                <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><img src="<?php echo $event['poster']; ?>" alt=""></a>
              </div>
              <div class="caption">
                <?php if(isset($event['theme'])) { ?>
                  <span class="theme"><?php echo $event['theme']['nom']; ?></span>
                <?php } ?>
                <?php if(isset($event['type'])) { ?>
                  <span class="theme"><?php echo $event['type']['nom'];?></span>
                <?php } ?>
                <h3><a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>"><?php echo $event['nom']; ?></a></h3>
                <?php
                  if((!empty($event['date_debut']) && empty($event['date_fin']) ) || ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] == $event['date_fin'])) {
                ?>
                <div class="date">Le <?php echo $event['date_debut']; ?></div>
                <?php
                  } else if(!empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] != $event['date_fin']) {
                ?>
                <div class="date">Du <?php echo $event['date_debut']; ?> au <?php echo $event['date_fin']; ?></div>
                <?php } ?>
              </div>
            </li>
         <?php } ?>
         </ul>
      </section>
      <?php } ?>
    </div>
    <aside class="profile-column">
      <section class="block">
        <h2 class="title">Contacter <?php echo $model['user']['nickname']; ?></h2>
        <div class="contact">
          <a class="button" href="<?php echo Config::get('config.base'); ?>/user/contact/<?php echo $model['user']['id']; ?>">Envoyer un mail</a>
        </div>
      </section>
    </aside>
  </div>
</div>
