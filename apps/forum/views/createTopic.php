        <section class="entete">
            <form method="post" action="PAGEPHP.php">
                <a class="normeforum" href="lieninexistant.com">Revenir au Forum</a>
                <a class="normeforum" href="lieninexistant.com">Mes topics</a>
                <label for="recherche"><input id="recherche" name="recherche" type="search" placeholder="search" /></label>
            </form>
        </section>
        <section class="principal">
            <form method="post" action="PAGEPHP.php">
                <h1>Sujet</h1><br/>
                <input type="text" required autofocus name='sujet' id='sujet'/><br/>
                <h1>Ajouter un commentaire</h1>
                <textarea required name='commentaire' id="commentaire"></textarea><br/>
                <div class="lier">
                    <label class="evenement" for="evenement">Lier à l'événement : </label>
                    <input type="text" id="evenement" name="evenement">
                </div><br/>
                <input class="valider" type="submit" value="Créer le sujet">
                <input class="Annuler" type="submit" value="Annuler">
            </form>
        </section>
    </body>
</html>
