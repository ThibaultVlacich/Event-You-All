<section class="app-user app-user-signup">
    <form method="post" action="/user/signup" >
        <h2>S'inscrire</h2>
        <div class="centre">
            <div class="plusieurs">
                <label for='nom'>Nom*  </label>
                <input type='text' name='nom' id='nom' maxlength="12" required placeholder="ex : Smith">
            </div>
            <div class="plusieurs">
                <label class="right" for='prenom'>Prénom*  </label>
                <input class="right" type='text' name='prenom' id='prenom' maxlength="12" required placeholder="ex : Boby">
            </div>
            <div class="long">
                <div class="label">
                    <label for='mail'>Adresse e-mail*  </label>
                </div>
                <input  type='email' name='mail' id='mail' maxlength="30" required placeholder="ex : boby.smith@event.com">
            </div>
            <div class="plusieurs">
                <label for='pass'>Mot de passe*  </label>
                <input type='password' name='pass' id='pass' maxlength="20" required placeholder="...........">
            </div>
            <div class="plusieurs">
                <label class="right" for='cpass'>confirmation*  </label>
                <input class="right" type='password' name='cpass' id='cpass' maxlength="20" required placeholder="..........">
            </div>
            <div class="long">
                <div class="label">
                    <label for='adr'>Adresse  </label>
                </div>
                <input type='text' name='adr' id='adr' maxlength="30" placeholder="ex : 12 rue event">
            </div>
            <div class="plusieurs">
                <label for='cp'>Code postal  </label>
                <input type='text' name='cp' id='cp' maxlength="5" placeholder="ex : 75015">
            </div>
            <div class="plusieurs">
                <label class="right" for='city'>Ville  </label>
                <input class="right" type='text' name='city' id='city' maxlength="10" placeholder="ex : Paris">
            </div>
            <div class="plusieurs">
                <label class="right" for='pays'>Pays  </label>
                <select class="right" name='pays' id='pays' >
                   <option value='FR'>France</option>
                  <option value='CN'>Canada</option>
            </select>
            </div>
            <div class="long">
                <div class="label">
                    <label for='tel'>Telephone  </label>
                </div>
            <input type='text' name='tel' id='tel' maxlength="14" placeholder="ex : 03 80 73 48 76">
            </div>
        </div>
        <p ><input type='checkbox' name='infom' id='infom' checked/>
             <label for='infom'>J'accepte de recevoir les newsletter par mail</label></p>
         <p><input type='checkbox' name='condi' id='condi' required/>
             <label for='condi'>J'accepte les conditions d'utilisation du site... *</label></p>
         <br>
         <p class="gauche">* : champs obligatoires</p>
         <p><input id="bouton" type='submit' value='Envoyer'/></p>
    </form>
    <a class="gauche" href="pageconnexion.html">Déja inscrit ?</a>
</section>
