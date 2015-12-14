<div class="slider">

</div>
<div class="app-events app-events-home">
  <div class="search_h">
    <form method="post" action="truc.php">
      <select name='region' id='region'>
        <option selected disabled>Région</option>
        <option value=''>Île-de-France</option>
        <option value=''>Berry</option>
      </select>
      <select name='theme' id='theme'>
        <option selected disabled>Thème</option>
        <optgroup label='Musique' />
        <option value='classique'>Classique</option>
        <option value='metal'>Metal</option>
        <option value='rock'>Rock</option>
        <option value='autres_m'>Autres</option>
        <optgroup label='Cinema' />
        <option value='action'>Action</option>
        <option value='thriller'>Thriller</option>
        <option value='familial'>Familial</option>
        <option value='comedie'>Comedie</option>
        <option value='autres_c'>Autres</option>
        <optgroup label='Image' />
        <option value='peinture'>Peinture</option>
        <option value='photographie'>Photographie</option>
        <option value='autres_i'>Autres</option>
      </select>
      <input type="date" placeholder="Date">
      <input type="submit">
    </form>
  </div>
  <section>
    <ul>
      <?php foreach($model as $event) { ?>
      <li>
        <div class="image">
          <img src="<?php echo $event['poster']; ?>" alt="" />
        </div>
        <div class="event_text">
          <h2><?php echo $event['nom']; ?></h2>
          <?php
            if (( !empty($event['date_debut']) && empty($event['date_fin']) ) || ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] == $event['date_fin'] )) {
          ?>
            <p>Le <?php echo $event['date_debut']; ?></p>
          <?php
            } else if ( !empty($event['date_debut']) && !empty($event['date_fin']) && $event['date_debut'] != $event['date_fin'] ) {
          ?>
            <p>Du <?php echo $event['date_debut']; ?> au <?php echo $event['date_fin']; ?></p>
          <?php
            }
          ?>
          <div class="liens_ima">
            <a href="home.html"><img src="<?php echo Config::get('config.base') ; ?>/apps/events/images/coeur.png" alt="like" class="coeur"></a>
            <a href="home.html"><img src="<?php echo Config::get('config.base') ; ?>/apps/events/images/croix.png" alt="add" class="croix"></a>
          </div>
          <img src="<?php echo Config::get('config.base') ; ?>/apps/events/images/triangle rot.png" alt="fleche" class="fleche">
        </div>
        <a href="<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $event['id']; ?>" class="link"></a>
      </li>
      <?php } ?>
    </ul>
  </section>
</div>
