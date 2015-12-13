<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Article</title>
        <link rel="stylesheet" href="Article.css"/> 
    </head>
    <body>
        <div id="entete">
            <h1><?php echo $model['nom']; ?></h1>
        </div>
        <div id="contenu">
            <p id="description"><?php echo $model['contenu']; ?></p>
        </div>
        <ul>
            <li><div id=avatar_organisateur></div></li>
            <li><h3>Mr.Jones :</h3></li>
            <li><div class="bouton">
                <a href="#">Voir la page de l'organisateur</a>           
                </div>
            </li>
            <li><div class="bouton">
                <a href="#">Voir la page de l'évenement</a>
                </div>
            </li>
            <!--insérer note de l'auteur-->
        </ul>
        <h3 id=avis>Avis :</h3>
        <div class="commentaire">
            <div class=avatar></div>
            <h4>Mr.a</h4>
            <p class="p_commentaire">Trop cool!!</p>
        </div>
        <div class="commentaire">
            <div class=avatar></div>
            <h4>Mr.b</h4>
            <p class="p_commentaire">J'adore ce groupe il est vraiment trop super cool lolilol xptdr mdr</p>
        </div>
        <div class="commentaire">
            <div class=avatar></div>
            <h4>Mr.c</h4>
            <p class="p_commentaire">oui</p>
        </div>
        <div class="bouton" id=Aj_com>
            <a href="#">Ajouter un commentaire</a>
        </div>
    </body>
</html>