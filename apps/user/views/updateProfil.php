        <div id="divpage">
            <h1 class= 'entetecompte'>Mon Compte</h1>
            <?php
              if (isset($model['success']) && $model['success'] === true) {
            ?>
            <div class="note success">
              <i class="fa fa-spin fa-spinner"></i>
              <ul>
                <li>Votre compte a été mis à jour avec succès !</li>
                <li>Vous allez être redirigé dans 3 secondes.</li>
              </ul>
            </div>
            <script type="text/javascript">
              setTimeout(function() {
                window.location = '<?php echo Config::get('config.base'); ?>';
              }, 3000);
            </script>
            <?php
                return;
              }

              elseif(isset($model['success']) && $model['success'] === false){
            ?>
            <div class="note error">
              <i class="fa fa-exclamation-triangle"></i>
              <ul>
                  <li>Echec de la mise à jour</li>
              </ul>
            </div>
            <?php
              }
            ?>
                <h2 class='entetecompte'>Mon Profil</h2>
                <section>
                  <form enctype="multipart/form-data" method="POST" action = "<?php echo Config::get('config.base'); ?>/user/updateProfil">
                      <div class="photodemoi">
                              <p class="Principal">
                                  <img class="photoinconnu" src="<?php echo $model['data']['photoprofil']; ?>" alt="Photo d'inconnu"/>
                              </p>
                              <p>
                                  <input type="file" class="photoperso" name='photoprofil'/><br/>
      						</p>
                              <p><label class="laissercommentaire" for="commentaire">Laissez un commentaire sur vous !</label><br/></p>
                                  <textarea class="textlaissercommentaire" name="commentaire" id="commentaire" value='<?php echo $model['data']['commentaire']; ?>'></textarea><br/>
                                  <input class='boutoncompte' type = 'submit' value='Valider'>
                                  <a class='boutoncompte' href = '<?php echo Config::get('config.base'); ?>/user/myprofil'>Annuler</a>

                      </div>
                      <div class="infoperso">
                          <div class="infoperso1">
                                  <p class="nom"><span class='base'>Nom :</span><?php echo $model['data']['lastname']; ?></p>
                                  <p class="prenom"><span class ='base'>Prénom :</span>	<?php echo $model['data']['firstname'];?></p><p class="datedenaissance"><span class ='base'>Date de naissance :</span> <?php echo $model['data']['birthdate'];?></p>
                                    <input name='birthdate' type='date'/>
                                  <p id="sexe"><span class='base'>Sexe :</span>  <?php echo $model['data']['sex'];?> </p>
                                    <select name='sex'>
                                      <option selected disabled>Non renseigné</option>
                                        <option value='M'>Homme</option>
                                        <option value='F'>Femme</option>
                                    </select>
                          </div>
                          <div class="infoperso2"><br/>
                                      <label for="adressephysique" id='adressephysique'><span class='base'>Adresse :</span> </label><?php echo $model['data']['adress'];?><br/>
                                        <input type='text' name='adress'/><br/>
                                      <label for='pays' class='pays'> <span class='base'>Pays :</span>   </label><?php echo $model['data']['country'];?><br/>
                                      <select name="country" class="pays" >
                                        <option value="FR">France</option>
                                        <option value="CN">Canada</option>
                                      </select><br/>
                                      <label for="codepostal" class='codepostal'><span class='base'>Code Postal :</span> </label><?php echo $model['data']['zip_code'];?><br/>
                                        <input class ='codepostal' type='number' name='zip_code'/><br/>
                                      <label for="Ville" class='ville'><span class='base'>Ville :</span> </label><?php echo $model['data']['city'];?><br/>
                                        <input type='text' name='city' class='ville'/><br/>
                                      <label for="adressemail" id='adressemail'><span class='base'>Mon Adresse Mail :</span> </label><?php echo $model['data']['email'];?><br/>
                                        <input name='mail' type='mail'/><br/>
                                      <label for="telephone" id='telephone'><span class='base'>Numéro de Téléphone :</span> </label><?php echo $model['data']['phone'];?><br/>
                                        <input name='phone' type='tel'/><br/>
                          </div>
                      </div>
                    </form>
                </section>
        </div>
