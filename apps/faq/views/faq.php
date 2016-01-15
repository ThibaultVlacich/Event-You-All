<!--Static title -->
<h2> FAQ
</h2>
        <!--haut page-->
        <div class="text">
          <?php  foreach($model as $qw) { ?>
            <section class="QW">
                <p class="question"> <?php echo $qw['question']; ?></p>
                <p class="reponse"><?php echo $qw['reponse']; ?></p>
            </section>


          <?php } ?>



        </div>

          <section class="conteneur">
          <a href="contact" class="button">Contactez nous</a>
         </section>

          </section>
        <!--bas page-->
