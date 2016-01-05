<div class="app-contact">
  <h2>Contact</h2>
  <div class="form">

      <form method="post" action='http://localhost/Event-You-All/contact/contactconfirm' >
      <div>
        <label for="subject" >Sujet <span class="required">*</span></label> <input type="text" name="subject" id="subject" required />
        <label for="message">Message <span class="required">*</span></label> <textarea name="message" id="message" required /></textarea>
        <label for="lastname">Nom <span class="required">*</span></label> <input type="text" name="lastname" id="lastname" required />
        <label for="firstname">Prénom <span class="required">*</span></label> <input type="text" name="firstname" id="firstname" required />
        <label for="email">Adresse e-mail <span class="required">*</span></label> <input type="email" name="email" id="email" required />
        <p>* : champs obligatoires</p>

        <input type="submit" value="Envoyer" class="sent" id="sent" />
      </div>


  </div>
</div>
