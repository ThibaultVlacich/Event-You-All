<div class="app-contact">
  <h2>Contact</h2>
  <div class="form">
    <?php
      if (isset($model['success']) && $model['success'] === true) {
    ?>
    <div class="success">
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
    <div class="error">
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
    <form id="contact" method="post" action="<?php echo Config::get("config.base"); ?>/contact/contact">
      <div>
        <label for="subject">Sujet <span class="required">*</span></label> <input type="text" name="subject" id="subject" required />
        <label for="message">Message <span class="required">*</span></label> <input type="text" name="message" id="message" required />
        <label for="lastname">Nom <span class="required">*</span></label> <input type="text" name="lastname" id="lastname" required />
        <label for="firstname">Prénom <span class="required">*</span></label> <input type="text" name="firstname" id="firstname" required />
        <label for="email">Adresse e-mail <span class="required">*</span></label> <input type="email" name="email" id="email" required />
        <p>* : champs obligatoires</p>

        <input type="submit" value="Envoyer" class="sent" id="sent" />
      </div>
    </form>
    <?php
$mail = 'weaponsb@mail.fr'; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
//==========

//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========

//=====Définition du sujet.
$subjectm= "$subject";
//=========

//=====Création du header de l'e-mail.
$header = "From: $email.$passage_ligne;
$header.= "Reply-to: \"WeaponsB\" <weaponsb@mail.fr>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========

//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========
?>

  </div>
</div>