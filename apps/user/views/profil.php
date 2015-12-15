        <div id="LATOTALE">
            <h1>Mon Compte</h1>
                <h2>Modifier mon Profil</h2>
                <section>
                <div class="LAPHOTO">   
                        <p class="Principal">
                            <img class="photoinconnu" src="images/photoinconnu.jpeg" alt="Photo d'inconnu"/>
                        </p>
                        <p>
                            <input type="file" name="photoperso" class="photoperso"/><br/>
						</p>
                        <p><label class="laissercommentaire" for="commentaire">Laissez un commentaire sur vous !</label><br/></p>
                            <textarea class="textlaissercommentaire" name="commentaire" id="commentaire"></textarea>
                </div>
                <div class="infoperso">
                    <div class="infoperso1">
                            <input type="checkbox" id="Profilprive" name="Profilprive"/>
                            <label for="Profilprive">Profil privé</label><br/>
                            <p class="nom">Nom : <?php echo $model['lastname']; ?></p><p class="prenom">Prénom : 
							<?php echo $model['firstname'];?></p><p class="datedenaissance">Date de naissance : <?php echo $model['birthdate'];?></p>
                            <p id="sexe">Sexe :
                                <?php echo $model['sex'];?>
                            </p>
                    </div>
                    <div class="infoperso2"><br/>
                                <label for="adressephysique">Adresse : </label><?php echo $model['adress'];?><br/>
                                <label for="codepostal">Code Postal : </label><?php echo $model['zip_code'];?><br/>
                                <label for="Ville">Ville : </label><?php echo $model['city'];?><br/> 
                                <label for="adressemail">Mon Adresse Mail : </label><?php echo $model['email'];?><br/>
                                <label for="telephone">Numéro de Téléphone : </label><?php echo $model['phone'];?><br/>
                    </div>
                </div>             
                </section>
        </div>
