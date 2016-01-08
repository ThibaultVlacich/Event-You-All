        <div id="LATOTALESUPERCHOUETTE">
            <h1>Mon Compte</h1>
                <h2>Mon Profil</h2>
                <section>
                <div class="LAPHOTO">
                        <p class="Principal">
                            <img class="photoinconnu" src="<?php echo $model['photoprofil']; ?>" alt="Photo d'inconnu"/>
                        </p>
                        <p><label class="laissercommentaire" for="commentaire">Voici le commentaire que vous avez laissé :</label><br/></p>
            <div class='moncommentaire'><?php echo $model['commentaire']; ?></div>
                            <br/>
                            <a class='updateprofil' href = 'updateProfil'>Modifier mon profil</a>
                </div>
                <div class="infoperso">
                    <div class="infoperso1">
                            <p id="Profilprive" name="Profilprive"><?php echo $model['profilprive']; ?></p><br/>
                            <p class="nom">Nom : <?php echo $model['lastname']; ?></p><p class="prenom">Prénom :
							<?php echo $model['firstname'];?></p><p class="datedenaissance">Date de naissance : <?php echo $model['birthdate'];?></p>
                            <p id="sexe">Sexe :
                                <?php echo $model['sex'];?>
                            </p>
                    </div>
                    <div class="infoperso2"><br/>
                                <label for="adressephysique" id='adressephysique'>Adresse : </label><?php echo $model['adress'];?><br/>
                                <label for='pays' id='pays'> Pays : </label><?php echo $model['country'];?>
                                <label for="codepostal" id='codepostal'>Code Postal : </label><?php echo $model['zip_code'];?><br/>
                                <label for="Ville" id='ville'>Ville : </label><?php echo $model['city'];?><br/>
                                <label for="adressemail" id='adressemail'>Mon Adresse Mail : </label><?php echo $model['email'];?><br/>
                                <label for="telephone" id='telephone'>Numéro de Téléphone : </label><?php echo $model['phone'];?><br/>
                    </div>
                </div>
                </section>
        </div>
