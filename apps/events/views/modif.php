<?php
  if (!empty($model['errors'])) {
    // No event based on asked id
?>
<div class="note error">
  <i class="fa fa-exclamation-triangle"></i>
  <ul>
  <?php
    foreach ($model['errors'] as $error) {
      echo '<li>'.$error.'</li>';
    }
  ?>
  </ul>
</div>
<?php
    return;
  }
?>
<div class="app-events app-events-create">
  <h2 class="title">Modifier mon événement</h2>
  <form method="post" action="<?php echo Config::get('config.base'); ?>/events/modif_confirm/<?php echo $model['id'];?>" enctype="multipart/form-data">
    <div class="form-main">
      <div class="form-block full">
        <h3 class="form-block-title">&Agrave; propos de l'événement</h3>
        <div class="form-group full">
          <label for="nom">Nom <span class="required">*</span></label>
          <input type="text" name="nom" id="nom" required value="<?php echo $model['nom']; ?>">
        </div>
        <div class="form-group full">
          <label for="theme">Thème <span class="required">*</span></label>
          <select name='theme' id='theme'>
            <?php foreach ($model['themes'] as $theme) { ?>
            <option value="<?php echo $theme['id']?>"<?php echo ($model['id_theme'] == $theme['id']) ? ' selected' : ''; ?>><?php echo $theme['nom']?></option>
            <?php  } ?>
          </select>
        </div>
        <div class="form-group full">
          <label for="type">Type <span class="required">*</span></label>
          <select name='type' id='type'>
            <?php foreach ($model['types'] as $type) { ?>
            <option value="<?php echo $type['id']?>"<?php echo ($model['id_type'] == $type['id']) ? ' selected' : ''; ?>><?php echo $type['nom']?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Date de début <span class="required">*</span></label>
          <select name="date_de_j" id="date_de_j">
            <?php
              for ($i = 1; $i <= 31; $i++) {
                if ($i == date('j', $model['date_debut_timestamp'])) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
            ?>
          </select>
          <select name="date_de_m" id="date_de_m">
            <?php
              $months = array(
                1  => "Janvier",
                2  => "Février",
                3  => "Mars",
                4  => "Avril",
                5  => "Mai",
                6  => "Juin",
                7  => "Juillet",
                8  => "Août",
                9  => "Septembre",
                10 => "Octobre",
                11 => "Novembre",
                12 => "Décembre"
              );

              foreach ($months as $number => $month) {
                if ($number == date('n', $model['date_debut_timestamp'])) {
                  echo '<option value="'.$number.'" selected>'.$month.'</option>';
                } else {
                  echo '<option value="'.$number.'">'.$month.'</option>';
                }
              }
            ?>
          </select>
          <select name="date_de_a" id="date_de_a">
            <?php
              $annee_debut = (date('Y', $model['date_debut_timestamp']) < date('Y')) ? date('Y', $model['date_debut_timestamp']) : date('Y');

              for ($i = $annee_debut; $i <= $annee_debut + 2; $i++) {
                if ($i == date('Y', $model['date_debut_timestamp'])) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
            ?>
          </select>
          &nbsp;à&nbsp;
          <select name='time_de_h' id='time_de_h'>
            <?php
              for ($i = 0; $i <= 23; $i++) {
                if ($i == date('G', $model['date_debut_timestamp'])) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
            ?>
          </select>
          :
          <select name='time_de_m' id='time_de_m'>
            <?php
              foreach (array('00', '15', '30', '45') as $i) {
                if ($i == date('i', $model['date_debut_timestamp'])) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="date_fi_j">Date de fin <span class="required">*</span></label>
          <select name="date_fi_j" id="date_fi_j">
            <?php
              for ($i = 1; $i <= 31; $i++) {
                if ($i == date('j', $model['date_fin_timestamp'])) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
            ?>
          </select>
          <select name="date_fi_m" id="date_fi_m">
            <?php
              $months = array(
                1  => "Janvier",
                2  => "Février",
                3  => "Mars",
                4  => "Avril",
                5  => "Mai",
                6  => "Juin",
                7  => "Juillet",
                8  => "Août",
                9  => "Septembre",
                10 => "Octobre",
                11 => "Novembre",
                12 => "Décembre"
              );

              foreach ($months as $number => $month) {
                if ($number == date('n', $model['date_fin_timestamp'])) {
                  echo '<option value="'.$number.'" selected>'.$month.'</option>';
                } else {
                  echo '<option value="'.$number.'">'.$month.'</option>';
                }
              }
            ?>
          </select>
          <select name="date_fi_a" id="date_fi_a">
            <?php
              $annee_debut = (date('Y', $model['date_fin_timestamp']) < date('Y')) ? date('Y', $model['date_fin_timestamp']) : date('Y');

              for ($i = $annee_debut; $i <= $annee_debut + 2; $i++) {
                if ($i == date('Y', $model['date_fin_timestamp'])) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
            ?>
          </select>
          &nbsp;à&nbsp;
          <select  name='time_fi_h' id='time_fi_h'>
            <?php
              for ($i = 0; $i <= 23; $i++) {
                if ($i == date('G', $model['date_fin_timestamp'])) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
            ?>
          </select>
          :
          <select  name='time_fi_m' id='time_fi_m'>
            <?php
              foreach (array('00', '15', '30', '45') as $i) {
                if ($i == date('i', $model['date_fin_timestamp'])) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group full">
          <label for="nbpl">Capacité <span class="required">*</span></label>
          <input type="number" name="nbpl" id="nbpl" required min="2" value="<?php echo $model['capacite']; ?>">
        </div>
        <div class="form-group full">
          <label for="price">Prix (euros) <span class="required">*</span></label>
          <input type="number" name="price" id="price" required min="0" value="<?php echo $model['prix']; ?>">
        </div>
      </div>
      <!--<div class="form-block">
        <h3>Paramètres d'inscription (si événement privé)</h3>
        <div class="centre">

          <div class="label">
            <label for="gpadm">Groupes admis </label>
          </div>
          <div class="fill">
            <input type="text" name="gpadm" id="gpadm" placeholder="groupe1, groupe2, groupe3...">
          </div>

          <div class="label">
            <label for="padm">Personnes admises </label>
          </div>
          <div class="fill">
            <input type="text" name="padm" id="padm" placeholder="personne1, personne2, personne3...">
          </div>
        </div>
        <br>
      </div>
      <div class="form-block">
        <h3>Black list</h3>
        <div class="centre">
          <div class="label">
            <label for="blist">Personnes non admises </label>
          </div>
          <div class="fill">
            <input type="text" name="blist" id="blist" placeholder="personne1, personne2, personne3...">
          </div>
        </div>
        <br>
      </div>-->
      <div class="form-block">
        <h3 class="form-block-title">Organisateur</h3>
        <div class="form-group">
          <label for="partn">Partenaires et Sponsors </label>
          <input type="text" name="partn" id="partn" value="<?php echo $model['sponsors']; ?>">
        </div>
        <div class="form-group">
          <label for="weborg">Site internet </label>
          <input type="text" name="weborg" id="weborg" value="<?php echo $model['site_web']; ?>">
        </div>
      </div>
      <div class="form-block">
        <h3 class="form-block-title">Lieu</h3>
        <div class="form-group full">
          <label for="adr">Adresse <span class="required">*</span></label>
          <input type="text" name="adr" id="adr" required value="<?php echo $model['adresse']; ?>">
        </div>
        <div class="form-group full">
          <label for="code_p">Code postal <span class="required">*</span></label>
          <input type="text" name="code_p" id="code_p" required minlength="5" maxlength="5" value="<?php echo $model['code_postal']; ?>">
        </div>
        <div class="form-group full">
          <label for="ville">Ville <span class="required">*</span></label>
          <input type="text" name="ville" id="ville" required value="<?php echo $model['ville']; ?>">
        </div>
        <div class="form-group full">
          <label for="reg">Région <span class="required">*</span></label>
          <select  name="reg" id="reg">
          <?php foreach ($model['regions'] as $region) { ?>
            <option value="<?php echo $region['id']; ?>"<?php if ($region['id'] == $model['region']) echo ' selected'; ?>><?php echo $region['nom']; ?></option>
          <?php } ?>
          </select>
        </div>
        <div class="form-group full">
          <input type="text" value="<?php echo $model['pays']; ?>" disabled>
          <input type="hidden" name="pays" id="pays" value="<?php echo $model['pays']; ?>">
        </div>
      </div>
      <div class="form-block">
        <h3 class="form-block-title">Page de l'événement</h3>
        <div class="form-group">
          <label for="descript">Description <span class="required">*</span></label>
          <textarea required id="description" name="descript"><?php echo $model['description']; ?></textarea>
        </div>
        <div class="form-group full">
          <label for="poster">Poster (si vous souhaitez le modifier)</label>
          <input type="file" id="poster" name="poster">
          <em class="legend">Dimensions minimales : 90*160px. Dimensions maximales : 450*800px.</em>
        </div>
        <div class="form-group full">
          <label for="bann">Bannière (si vous souhaitez la modifier)</label>
          <input type="file" id="bann" name="bann">
          <em class="legend">Dimensions minimales : 1600*900px. Dimensions maximales : 3200*1800px.</em>
        </div>
        <div class="form-block">
        <h3 class="form-block-title">Privatisation</h3>
        <div class="form-group full">
          <label for="partn">Membres admis</label>
          <input type="text" name="vip" id="vip" placeholder="utilisateur1,utilisateur2" value="<?php echo $model['vip']; ?>">
          <p>Laissez ce champ vide si vous voulez que votre événement reste publique</p>
        </div>
      </div>
        <!--<p>
            <input type="checkbox" name="sujet" id="sujet" />
            <label for="sujet">Créer un sujet dans le forum</label>
        </p>-->
      </div>
      <!--<div class="create_part">
        <h3>7-Invitation à l'événement</h3>
        <div class="centre">

          <div class="label">
            <label for="invitm">Envoyer un e-mail d'invitation à </label>
          </div>
          <br>
          <textarea name="invitm" rows=10 cols=100 placeholder="invite@gmail.com, invite3@gmail.com ..."></textarea>

        </div>
      </div>-->
    </div>
    <aside class="form-column">
      <div class="form-block sticky">
        <h3 class="form-block-title">Valider</h3>
        <p><span class="required">*</span> : champ obligatoire</p>
        <input type="submit" value="Envoyer">
        <input type="button" onclick="history.back()" value="Annuler">
      </div>
    </aside>
  </form>
</div>
