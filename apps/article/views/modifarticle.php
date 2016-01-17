 <?php
            if (empty($model)) {
              // No event based on asked id
          ?>
          <div class="note error">
            <i class="fa fa-exclamation-triangle"></i>
            <ul>
              <li>L'événement demandé n'existe pas !</li>
            </ul>
          </div>
          <?php
              return;
            }?>
            <?php
            $session = System::getSession();
            if($session->isConnected()) {
              // User is logged in
              $user_id = $_SESSION['userid'];

              if ($model['creator']['id'] == $user_id) {
                // User is the creator?>
<section class="blocinscri">
            <form method='post' action='<?php echo Config::get('config.base'); ?>/article/modif_confirm/<?php echo $model['id']?>' enctype="multipart/form-data">
                <h2>Modifier mon article</h2>
				<div class="create_part" >
                <h3>1-A propos de l'Article</h3>
                <div class="centre">
                    <div class="long">
                        <div class="label">
                            <label for='nom'>Nom<span class="required">*</span>  </label>
                        </div>
                        <input type='text' name='nom' id='nom' required placeholder="ex : Mon evenement" value="<?php echo $model['nom'] ?>">
                    </div>
                    <div class="long">
                        <div class="label">
                            <label for='type'>Type<span class="required">*</span>  </label>
                        </div>
                        <select  name='type' id='type'>
                                <option value='bilan'>Bilan</option>
                                <option value='autres_type'>Autres</option>
                        </select>
                    </div>
                    <br>
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
                        <textarea required name="corps" id="corps" rows=10 cols=100><?php echo $model['contenu'] ?></textarea>
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
                     <label for='condi'>J'accepte les <a href="<?php echo Config::get('config.base'); ?>/cgu">conditions d'utilisation</a> du site... <span class="required">*</span></label></p>
                 <br>
                 <p class="gauche"><span class="required">*</span> : champs obligatoires</p>
                 <!--Mettre différentes fonctions à chaque bouton -->
                 <p><input id="bouton" type='submit' value='Envoyer'/>
                <input id="bouton" type='button' onclick="window.history.back()" value='Annuler'/></p>
            </form>

        </section>
            <?php } }?>
