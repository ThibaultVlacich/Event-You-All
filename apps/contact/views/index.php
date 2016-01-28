<?php
  $session = System::getSession();

  if($session->isConnected()) {
    include_once APPS_DIR.'user'.DS.'model.php';

    $userModel = new UserModel();

    $user = $userModel->getUser($_SESSION['userid']);
  }
?>
<div class="app-contact">
  <h2>Contact</h2>
  <div class="form">

      <form method="post" action="<?php echo Config::get('config.base'); ?>/contact/contactconfirm">
      <div>
        <label for="subject">Sujet <span class="required">*</span></label> <input type="text" name="subject" id="subject" required />
        <p id="errorS">Votre sujet doit contenir entre 2 et 200 lettres! </p>
        <label for="message">Message <span class="required">*</span></label> <textarea name="message" id="message" required ></textarea>
        <p id="errorM">Votre message doit contenir entre 2 et 5000 lettres! </p>
        <label for="lastname">Nom <span class="required">*</span></label> <input type="text" name="lastname" id="lastname" value="<?php echo isset($user) ? $user['lastname'] : ''; ?>" required />
        <p id="errorL">Votre nom doit contenir entre 1 et 40 lettres! </p>
        <label for="firstname">Prénom <span class="required">*</span></label> <input type="text" name="firstname" id="firstname" value="<?php echo isset($user) ? $user['firstname'] : ''; ?>" required />
        <p id="errorF">Votre sujet doit contenir entre 1 et 40 lettres! </p>
        <label for="email">Adresse e-mail <span class="required">*</span></label> <input type="email" name="email" id="email" value="<?php echo isset($user) ? $user['email'] : ''; ?>" required />
        <p id="errorEM">Ceci n'est pas une adresse e-mail! </p>
        <p>* : champs obligatoires</p>

        <input type="submit" value="Envoyer" class="sent" id="sent" />
      </div>
    </form>

  </div>
</div>
