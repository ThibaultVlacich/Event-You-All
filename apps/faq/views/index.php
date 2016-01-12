        <!--haut page-->
        <section class="blocinscri">
            <h2>F.A.Q</h2>


          <!-- <form method='post' action='pagecontacte.php' >
                 <p><input id="bouton" type='submit' value='Si vous ne trouvez pas de réponses à votre question, contactez nous'/></p>
            </form> -->

          <!--Search in db-->
          <?php  foreach($model as $QW) { ?>
            <section class="QW">
                <p class="question"> <?php echo $QW['question']; ?></p>
                <p class="reponse"><?php echo $QW['reponse']; ?></p>
            </section>


          <?php } ?>
          <section class="conteneur">
          <a href="cgu" class="button">Contactez nous</a>
         </section>

          </section>
        <!--bas page-->
