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
            <form method='post' action='<?php echo Config::get('config.base'); ?>/article/create_confirm' enctype="multipart/form-data">
                <h2>Ecrire un article</h2>
				<div class="create_part" >
                <h3>1-A propos de l'Article</h3>
                <div class="centre">
                    <div class="long">
                        <div class="label">
                            <label for='nom'>Nom<span class="required">*</span>  </label>
                        </div>
                        <input type='text' name='nom' id='nom' required placeholder="ex : Mon evenement">
                    </div>
                    <br>
                    <div class="long">
                        <div class="label">
                            <label for='arti'>Evénement lié à mon Article </label>
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
                        <textarea required name="corps" id="corps" rows=10 cols=100>Bla bla bla </textarea>
                    </div>
                    <div class="long">
                        <div class="label">
                            <label for='bann'>Bannière  </label>
                        </div>
                        <input type="file" id="bann" name="bann">
                        <p class='gauche'>Dimensions minimales : 1600*900px. Dimensions maximales : 3200*1800px.</p>
                        <!--mettre les vrais dimensions-->
                    </div>

                </div>
				</div>
                 <p><input type='checkbox' name='condi' id='condi' required/>
                     <label for='condi'>J'accepte les <a href="<?php echo Config::get('config.base'); ?>/cgu">conditions d'utilisation</a> du site... <span class="required">*</span></label></p>
                 <br>
                 <p class="gauche"><span class="required">*</span> : champs obligatoires</p>
                 <!--Mettre différentes fonctions à chaque bouton -->
                 <p><input id="bouton" type='submit' value='Envoyer'/>
                    <input id="bouton" type='button' onclick="window.history.back()" value='Annuler'/></p>
            </form>

        </section>
