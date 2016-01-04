<section class="blocinscri">
  <form method="post" action="<?php echo Config::get('config.base'); ?>/events/create_confirm" enctype="multipart/form-data">
    <h2>Créer un nouvel événement</h2>
    <div class="create_part" class="r1">
      <h3>1-A propos de l'événement</h3>

      <div class="centre">

        <div class="label">
          <label for="nom">Nom
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <input type="text" name="nom" id="nom" required placeholder="ex : Mon evenement">
        </div>
        <div class="label">
          <label for="mail">Theme
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
                    <select  name='theme' id='theme'>
						<?php
							  foreach ($model['genre'] as $event) {
							?>
							<option value=
							<?php echo $event['id']?>
							>
							<?php echo $event['nom']?>
							</option>
							<?php
							}
							?>
          </select>
        </div>
        <div class="label">
          <label for="type">Type
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <select  name='type' id='type'>
						<?php
							  foreach ($model['type'] as $event) {
							?>
							<option value=
							<?php echo $event['id']?>
							>
							<?php echo $event['nom']?>
							</option>
							<?php
							}
							?>
          </select>
        </div>
        <br>
        <!--les champs ne marchent pas pour firefox d"où le placeholder...-->
        <div class="label">
          <label for="date_de_j">Début
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <select name="date_de_j" id="date_de_j">
            <?php
              for ($i = 1; $i <= 31; $i++) {
                echo '<option value="'.$i.'">'.$i.'</option>';
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
                echo '<option value="'.$number.'">'.$month.'</option>';
              }
            ?>
          </select>
          <select name="date_de_a" id="date_de_a">
            <option>
              <?php echo date('Y'); ?>
            </option>
            <option>
              <?php echo date('Y') + 1; ?>
            </option>
            <option>
              <?php echo date('Y') + 2; ?>
            </option>
          </select>
          à
                        <!--Heures et minutes-->
                        <select  name='time_de_h' id='time_de_h'>
                            <?php
                            for ($i = 0; $i <= 24; $i++) {
                                if ($i== substr($model['heure_debut'], 0, -3) )
                                {echo '<option selected value="'.$i.'">'.$i.'</option>';}
                            else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            }
                            ?>
                        </select>
                        :
                        <select  name='time_de_m' id='time_de_m'>
                            <?php
                            for ($i = 0; $i <= 3; $i++) {
                                $minutes=$i*15;
                                if ($minutes== substr($model['heure_debut'], 3, 0) )
                                {echo '<option selected value="'.$minutes.'">'.$minutes.'</option>';}
                            else{
                            echo '<option value="'.$minutes.'">'.$minutes.'</option>';
                            }
                            }
                            ?>
                        </select>
        </div>
        <div class="label">
          <label for="date_fi_j">Fin
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <select name="date_fi_j" id="date_fi_j">
            <?php
              for ($i = 1; $i <= 31; $i++) {
                echo '<option value="'.$i.'">'.$i.'</option>';
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
                echo '<option value="'.$number.'">'.$month.'</option>';
              }
            ?>
          </select>
          <select name="date_fi_a" id="date_fi_a">
            <option>
              <?php echo date('Y'); ?>
            </option>
            <option>
              <?php echo date('Y') + 1; ?>
            </option>
            <option>
              <?php echo date('Y') + 2; ?>
            </option>
          </select>
          à 
                        <!--Heures et minutes-->
                        <select  name='time_fi_h' id='time_fi_h'>
                            <?php
                            for ($i = 0; $i <= 24; $i++) {
                                if ($i== substr($model['heure_debut'], 0, -3) )
                                {echo '<option selected value="'.$i.'">'.$i.'</option>';}
                            else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            }
                            ?>
                        </select>
                        :
                        <select  name='time_fi_m' id='time_fi_m'>
                            <?php
                            for ($i = 0; $i <= 3; $i++) {
                                $minutes=$i*15;
                                if ($minutes== substr($model['heure_fin'], 3, 0) )
                                {echo '<option selected value="'.$minutes.'">'.$minutes.'</option>';}
                            else{
                            echo '<option value="'.$minutes.'">'.$minutes.'</option>';
                            }
                            }
                            ?>
                        </select>
        </div>
        <br>
        <div class="label">
          <label for="nbpl">Capacité
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <input type="number" name="nbpl" id="nbpl" required min="2" placeholder="10">
        </div>
        <div class="label">
          <label for="price">Prix (euros)
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <input type="number" name="price" id="price" required min="0" placeholder="0">

        </div>
        <div class="label">
          <label for="mclef">Mots clefs </label>
        </div>
        <div class="fill">
          <input type="text" name="mclef" id="mclef" maxlength="100" placeholder="motclef1, motclef2, motclef3...">
        </div>
        <br>
        <p>
          <input type="checkbox" name="priv" id="priv" />

          <label for="priv">Privé</label>
        </p>
      </div>
      <br>
    </div>
    <div class="create_part2">
      <h3>2-Paramètres d'inscription (si événement privé)</h3>
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
    <div class="create_part">
      <h3>3-Black list</h3>
      <div class="centre">
        <div class="label">
          <label for="blist">Personnes non admises </label>
        </div>
        <div class="fill">
          <input type="text" name="blist" id="blist" placeholder="personne1, personne2, personne3...">
        </div>
      </div>
      <br>
    </div>
    <div class="create_part2">
      <h3>4-Organisateur</h3>
      <div class="centre">
        <div class="label">
          <label for="partn">Partenaires et Sponsors </label>
        </div>
        <div class="fill">
          <input type="text" name="partn" id="partn" placeholder="partenaire1, partenaire2, sponsor1...">
        </div>

        <div class="label">
          <label for="weborg">Site internet </label>
        </div>
        <div class="fill">
          <input type="text" name="weborg" id="weborg" placeholder="wwww.exemple.com">
        </div>
      </div>
      <br>
    </div>
    <div class="create_part">
      <h3>5-Lieu</h3>
      <div class="centre">
        <div class="label">
          <label for="reg">Région
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <select  name='reg' id='reg'>
						<?php
							  foreach ($model['region'] as $event) {
							?>
							<option value=
							<?php echo $event['id']?>
							>
							<?php echo $event['nom']?>
							</option>
							<?php
							}
							?>
          </select>
        </div>

        <div class="label">
          <label for="adr">Adresse
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <input type="text" name="adr" id="adr" required placeholder="14 rue event">
        </div>
        <div class="label">
          <label for="code_p">Code postal
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <input type="text" name="code_p" id="code_p" required minlength=5 maxlength="5" placeholder="00000">
        </div>
        <div class="label">
          <label for="ville">Ville
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <input type="text" name="ville" id="ville" required placeholder="Paris">
        </div>
        <div class="label">
          <label for="pays">Pays
            <span class="required">*</span>
          </label>
        </div>
        <div class="fill">
          <select name="pays" id="reg">
            <option value="fr">France</option>
            <option value="cn">Canada</option>
          </select>
        </div>
      </div>
      <br>
    </div>
    <div class="create_part2">
      <h3>6-Page de l'événement</h3>
      <div class="centre">
        <label for="descript">Description </label>
        <br>
        <textarea required id="description" name="descript" rows=10 cols=100>Bla bla bla </textarea>
        <br>
        <label for="bann">Bannière </label>
        <input type="file" id="bann" name="bann">
        <p class="gauche">Dimensions : 400px*900px</p>

        <!--mettre les vrais dimensions-->

        <label for="poster">Poster
        <span class="required">*</span>
        </label>

        <input required type="file" id="poster" name="poster">
        <p class="gauche">Dimensions : 400px*900px</p>

        <!--mettre les vrais dimensions-->

        <p>
          <input type="checkbox" name="sujet" id="sujet" />
          <label for="sujet">Créer un sujet dans le forum</label>
        </p>
      </div>
      <br>
    </div>
    <div class="create_part">
      <h3>7-Invitation à l'événement</h3>
      <div class="centre">

        <div class="label">
          <label for="invitm">Envoyer un e-mail d'invitation à </label>
        </div>
        <br>
        <textarea name="invitm" rows=10 cols=100 placeholder="invite@gmail.com, invite3@gmail.com ..."></textarea>

      </div>
    </div>
    <p>
      <input type="checkbox" name="condi" id="condi" required/>
      <label for="condi">J'accepte les conditions d'utilisation du site...
        <span class="required">*</span>
      </label>
    </p>
    <br>
    <p class="gauche">
      <span class="required">*</span> : champs obligatoires</p>
    <!--Mettre différentes fonctions à chaque bouton -->
    <p>
      <input id="bouton" type="submit" value="Envoyer" />
      <input id="bouton" type="submit" value="Enregistrer sans publier" />
      <input id="bouton" type="submit" value="Annuler" />
    </p>
  </form>
</section>
