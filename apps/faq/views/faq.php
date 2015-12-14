<!DOCTYPE html>
<!--
A faire : - changer le lien html vers connexion
          - inserrer la page dans le design du site (header, footer) et centrer le block
-->
<html>
    <head>
        <title>Event-You-All /Contact</title> <!-- changer le / en baton droit -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="faq.css"/>
    </head>
    <body>
        <!--haut page-->
        <section class="blocinscri">
            <h2>FAQ</h2>
            <form method='post' action='pagecontacte.php' >
                 <p><input id="bouton" type='submit' value='Si vous ne trouvez pas de réponses à votre question, contactez nous'/></p>
            </form>
            <section>
                <p class="question"> <?php echo($model[0])?></p>
                <p class="réponse">Utilisez la barre de recherche ci-dessus ou utilisez la page recherche avancée</p>
            </section>
            <section>
                <p class="question">Comment accéder à la page recherche avancée ?</p>
                <p class="réponse">Sous la barre de recherche, cliquez sur le lien "recherche avancée" </p>
            </section>
            <section>
                <p class="question">J'ai un problème avec mon php, css et html... que faire ?</p>
                <p class="réponse">Demande à Thibault </p>
            </section>
        </section>
        <!--bas page-->
    </body>
</html>
