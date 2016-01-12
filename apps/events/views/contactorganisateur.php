<div class="app-contact">
  <h2>Contacter l'organisateur</h2>
  <div class="form">

      <form method="post" action="<?php echo Config::get('config.base'); ?>/events/contactconfirm">
      <div>
        <label for="subject" >Sujet <span class="required">*</span></label> <input type="text" name="subject" id="subject" required />
        <label for="message">Message <span class="required">*</span></label> <textarea name="message" id="message" required ></textarea>
        <p>* : champs obligatoires</p>

        <input type="submit" value="Envoyer" class="sent" id="sent" />
      </div>
    </form>

  </div>
</div>
