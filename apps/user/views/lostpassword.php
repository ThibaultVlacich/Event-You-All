    <body>
        <section>
            <fieldset>
              <div class="form">
                <?php
                  if (isset($model['success']) && $model['success'] === true) {
                ?>
                <div class="note success">
                  <i class="fa fa-spin fa-spinner"></i>
                  <ul>
                    <li>L'opération s'est correctement déroulée. </li>
                    <li>Un email contenant votre nouveau mot de passe a été envoyé à votre adresse mail !</li>
                    <li>Vous allez être redirigé dans 5 secondes.</li>
                  </ul>
                </div>
                <script type="text/javascript">
                  setTimeout(function() {
                    window.location = '<?php echo Config::get('config.base'); ?>';
                  }, 5000000);
                </script>
                <?php
                    return;
                  }

                  if (!empty($model['errors'])) {
                ?>
                <div class="note error">
                  <i class="fa fa-exclamation-triangle"></i>
                  <ul>
                  <?php
                   {
                      echo '<li>'.$model['errors'].'</li>';
                    }
                  ?>
                  </ul>
                </div>
                <?php
                  }
                ?>
                <legend>Mot de passe oublié</legend>
                <form id="formulaire" method="GET" action="<?php echo Config::get('config.base'); ?>/user/lostpassword">
                    <label for="adressemail">Mail :</label><input type="email" name="adressemail" id="adressemail" autofocus required/>
                    <br/>
                    <label for="verif">Vérification Anti-Bot :</label><input type="text" id="verif" name="verif" />
                    <input class="envoyer" type="submit" value="Envoyer un nouveau mot de passe"/>



                </form>
            </fieldset>
        </section>
    </body>
</html>
