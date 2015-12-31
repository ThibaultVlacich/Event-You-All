        <div id="LATOTALE">
            <h1>Mon Compte</h1>
                <h2>Mon Profil</h2>
                <section>
                  <form method="GET" action = "<?php echo Config::get('config.base'); ?>/user/updateProfil">
                      <div class="LAPHOTO">
                              <p class="Principal">
                                  <img class="photoinconnu" src="<?php echo $model['photoprofil']; ?>" alt="Photo d'inconnu"/>
                              </p>
                              <p>
                                  <input type="file" class="photoperso" name='photoprofil'/><br/>
      						</p>
                              <p><label class="laissercommentaire" for="commentaire">Laissez un commentaire sur vous !</label><br/></p>
                                  <textarea class="textlaissercommentaire" name="commentaire" id="commentaire" value='<?php echo $model['commentaire']; ?>'></textarea><br/>
                                  <a class='updateprofil' href = 'updateProfil'>Valider</a>

                      </div>
                      <div class="infoperso">
                          <div class="infoperso1">
                                  <input type='checkbox' name='profilprive' id='Profilprive'/> Profil privé</p><br/>
                                  <p class="nom">Nom : <?php echo $model['lastname']; ?></p>
                                  <p class="prenom">Prénom :	<?php echo $model['firstname'];?></p><p class="datedenaissance">Date de naissance : <?php echo $model['birthdate'];?></p>
                                    <input name='birthdate' type='date'/>
                                  <p id="sexe">Sexe :  <?php echo $model['sex'];?> </p>
                                    <select name='sex'>
                                      <option selected disabled>Non renseigné</option>
                                        <option value='M'>Homme</option>
                                        <option value='F'>Femme</option>
                                    </select>
                          </div>
                          <div class="infoperso2"><br/>
                                      <label for="adressephysique" id='adressephysique'>Adresse : </label><?php echo $model['adress'];?><br/>
                                        <input type='text' name='adress'/><br/>
                                      <label for='pays' class='pays'> Pays :   </label><?php echo $model['country'];?>
                                      <label for="codepostal" class='codepostal'>Code Postal : </label><?php echo $model['zip_code'];?>
                                      <label for="Ville" class='ville'>Ville : </label><?php echo $model['city'];?><br/>
                                        <select name="country" class="pays" >
                                          <option value="FR">France</option>
                                          <option value="CN">Canada</option>
                                        </select>
                                        <input class ='codepostal' type='number' name='zip_code'/>
                                        <input type='text' name='city' class='ville'/><br/>
                                      <label for="adressemail" id='adressemail'>Mon Adresse Mail : </label><?php echo $model['email'];?><br/>
                                        <input name='mail' type='mail'/><br/>
                                      <label for="telephone" id='telephone'>Numéro de Téléphone : </label><?php echo $model['phone'];?><br/>
                                        <input name='phone' type='tel'/><br/>
                          </div>
                      </div>
                    </form>
                </section>
        </div>
