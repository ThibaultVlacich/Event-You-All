<ul id="haut">
    <a class="titreenteteforum" href="<?php echo Config::get('config.base'); ?>/forum"><li class="enteteforum">Revenir au Forum</li></a>
    <a href="#" class="titreenteteforum"><li class="enteteforum">Mes Topics</li></a>
</ul>
    <form method="post" action="<?php echo Config::get('config.base'); ?>/forum/create_confirm" enctype="multipart/form-data">
        <section class="principal">
              <div class="titre">
                <h1>Titre</h1><br/>
                <input type="text" required autofocus name='titre' id='sujet'/><br/>
              </div>
              <div class="description">
                <h1>Ajouter un commentaire</h1>
                <textarea required name='description' id="commentaire"></textarea><br/>
              </div>
                <input class="Envoyer" type="submit" value="Envoyer">
                <input class="Annuler" type="submit" value="Annuler">
        </section>
    </form>
