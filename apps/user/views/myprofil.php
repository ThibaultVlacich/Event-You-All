        <div id="divpage">
            <h1>Mon Compte</h1>
            <div class='meseventsettopics'>
              <a href='<?php echo Config::get('config.base'); ?>/user/mesevents' class='boutoncompte'>Mes événements</a>
              <a href='<?php echo Config::get('config.base'); ?>/user/mestopics' class='boutoncompte'>Mes Topics</a>
            </div>
                <h2>Mon Profil</h2>
                <section>
                <div class="photodemoi">
                        <p class="Principal">
                            <img class="photoinconnu" src="<?php echo $model['photoprofil']; ?>" alt="Photo d'inconnu"/>
                        </p>
                        <p><label class="laissercommentaire" for="commentaire"><span class='base'>Voici le commentaire que vous avez laissé :</span></label></p><br/>
            <div class='moncommentaire'><?php echo $model['commentaire']; ?></div>
                            <br/>
                            <div class='updateprofiletmdp'>
                              <a class='boutoncompte' href = "<?php echo Config::get('config.base'); ?>/user/updateProfil">Modifier mon profil</a>
                              <a class='boutoncompte' href = '<?php echo Config::get('config.base'); ?>/user/updatepassword'>Modifier mon Mot de Passe</a>
                            </div>
                </div>
                <div class="infoperso">
                    <div class="infoperso1">
                            <p class="nom"><span class='base'>Nom :</span> <?php echo $model['lastname']; ?></p><p class="prenom"><span class='base'>Prénom :</span>
							<?php echo $model['firstname'];?></p><p class="datedenaissance"><span class="base"> Date de naissance :</span><?php echo $model['birthdate'];?></p>
                            <p id="sexe"><span class='base'>Sexe :</span>
                                <?php echo $model['sex'];?>
                            </p>
                    </div><br/>
                    <div class="infoperso2">
                                <label for="adressephysique" id='adressephysique'><span class='base'>Adresse :</span> </label><?php echo $model['adress'];?><br/>
                                <label for='region' id='region'> <span class='base'>Region :</span> </label><?php echo $model['region'];?><br/>
                                <label for="codepostal" id='codepostal'><span class='base'>Code Postal :</span> </label><?php echo $model['zip_code'];?><br/>
                                <label for="Ville" id='ville'><span class='base'>Ville :</span> </label><?php echo $model['city'];?><br/>
                                <label for="adressemail" id='adressemail'><span class'base'>Mon Adresse Mail :</span> </label><?php echo $model['email'];?><br/>
                                <label for="telephone" id='telephone'><span class'base'>Numéro de Téléphone :</span> </label><?php echo $model['phone'];?><br/>
                    </div>
                </div>
                </section>
        </div>
