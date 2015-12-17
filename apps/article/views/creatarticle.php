<div class="app-events app-events-detail">
  <?php
    if (empty($model['evenements'])) {
      // No events created by user
  ?>
  <div class="note error">
    <i class="fa fa-exclamation-triangle"></i>
    <ul>
      <li>Vous ne pouvez pas écrire d'articles sans avoir créé un événement avant</li>
    </ul>
  </div>
  <?php
      return;
    }
  ?>
<section class="blocinscri">
            <form method='post' action='http://localhost/Event-You-All/article/create_confirm' >
                <h2>Ecrire un article</h2>
				<div class="create_part" >
                <h3>1-A propos de l'Article</h3>
                <div class="centre">
                    <div class="long">
                        <div class="label">
                            <label for='nom'>Nom*  </label>
                        </div>
                        <input type='text' name='nom' id='nom' required placeholder="ex : Mon evenement">
                    </div>
                    <div class="long">
                        <div class="label">
                            <label for='type'>Type*  </label>
                        </div>
                        <select  name='type' id='type'>
                                <option value='bilan'>Bilan</option>
                                <option value='autres_type'>Autres</option>
                        </select>
                    </div>
                    <div class="long">
                        <div class="label">
                            <label for='mclef'>Mots clefs  </label>
                        </div>
                        <input type='text' name='mclef' id='mclef' maxlength="100" placeholder="motclef1, motclef2, motclef3...">
                    </div>
                    <br>
                    <div class="long">
                        <div class="label">
                            <label for='arti'>Article lié à mon événément  </label>
                        </div>
                            <select  name='arti' id='arti'>
								<?php
									  foreach ($model['evenements'] as $event) {
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
                </div>
				</div>
				<div class="create_part2">
                    <h3>2-Corps de l'Article</h3>
                <div class="centre">
                    <!--mettre des boutons d'edition style insertion d'images, caracteres en gras... -->
                    <div class="long">
                        <div class="label">
                            <label for='corps'>Article  </label>
                        </div>
                        <br>
                        <textarea required name="corps" rows=10 cols=100>Bla bla bla </textarea>
                    </div>
                    <div class="long">
                        <div class="label">
                            <label for='bann'>Bannière  </label>
                        </div>
                        <input type="file" id="bann" name="bann">
                        <p class='gauche'>Dimensions : 400px*900px</p>
                        <!--mettre les vrais dimensions-->
                    </div>
                    
                </div>
				</div>
                 <p><input type='checkbox' name='condi' id='condi' required/> 
                     <label for='condi'>J'accepte les conditions d'utilisation du site... *</label></p>
                 <br>
                 <p class="gauche">* : champs obligatoires</p>
                 <!--Mettre différentes fonctions à chaque bouton -->
                 <p><input id="bouton" type='submit' value='Envoyer'/> 
                    <input id="bouton" type='submit' value='Enregistrer sans sauvegarder'/>
                    <input id="bouton" type='submit' value='Annuler'/></p>
            </form>
			
        </section>