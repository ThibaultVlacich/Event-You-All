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
            <h2>F.A.Q</h2>


          <!-- <form method='post' action='pagecontacte.php' >
                 <p><input id="bouton" type='submit' value='Si vous ne trouvez pas de réponses à votre question, contactez nous'/></p>
            </form> -->
          <?php  foreach($model as $QW) { ?>
            <section class="inpair">
                <p class="question"> <?php echo $QW['question']; ?></p>
                <p class="reponse"><?php echo $QW['reponse']; ?></p>
            </section>


          <?php } ?>
          <a href="pagecontacte.php" class="button">Contactez nous</a>
          

          </section>
        <!--bas page-->
    </body>
</html>
