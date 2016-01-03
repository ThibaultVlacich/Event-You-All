    <form method="post" action="<?php echo Config::get('config.base'); ?>/forum/create_confirm" enctype="multipart/form-data">
        <section class="entete">
                <a class="normeforum" href="<?php echo Config::get('config.base');?>/forum">Revenir au Forum</a>
                <a class="normeforum" href="lieninexistant.com">Mes topics</a>
                <label for="recherche"><input id="recherche" name="recherche" type="search" placeholder="rechercher" /></label>
        </section>
        <section class="principal">
              <div class="titre">
                <h1>titre</h1><br/>
                <input type="text" required autofocus name='titre' id='sujet'/><br/>
              </div>
              <div class="description">
                <h1>Ajouter un commentaire</h1>
                <textarea required name='description' id="commentaire"></textarea><br/>
              </div>
                <input class="valider" type="submit" value="Créer le sujet">
                <input class="Annuler" type="submit" value="Annuler">
        </section>
    </form>
