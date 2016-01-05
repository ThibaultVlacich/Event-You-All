<div class="app-contact">
  <h2>Contact</h2>
  <div class="form">
    <?php
      if (isset($model['success']) && $model['success'] === true) {
    ?>
    <div class="message success">
      <i class="fa fa-spin fa-spinner"></i>
      <ul>
        <li>Votre message a été envoyé avec succès</li>
        <li>Vous allez être redirigé dans 5 secondes.</li>
      </ul>
    </div>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = '<?php echo Config::get('config.base'); ?>';
      }, 5000);
    </script>
    <?php
        return;
      }

      if (!empty($model['errors'])) {
    ?>
    <div class="message error">
      <i class="fa fa-exclamation-triangle"></i>
      <ul>
      <?php
        foreach ($model['errors'] as $error) {
          echo '<li>'.$error.'</li>';
        }
      ?>
      </ul>
    </div>
    <?php
      }
    ?>

      <div>
        <label for="subject" >Sujet <span class="required">*</span></label> <input type="text" name="subject" id="subject" required />
        <label for="message">Message <span class="required">*</span></label> <textarea name="message" id="message" required /></textarea>
        <label for="lastname">Nom <span class="required">*</span></label> <input type="text" name="lastname" id="lastname" required />
        <label for="firstname">Prénom <span class="required">*</span></label> <input type="text" name="firstname" id="firstname" required />
        <label for="email">Adresse e-mail <span class="required">*</span></label> <input type="email" name="email" id="email" required />
        <p>* : champs obligatoires</p>

        <input type="submit" value="Envoyer" class="sent" id="submit" />
      </div>


  </div>
</div>
