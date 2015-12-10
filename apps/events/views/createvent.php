        <section class="blocinscri">
            <form method='post' action='http://localhost/Event-You-All/events/create_confirm' >
                <h2>Créer un nouvel événement</h2>
              <div class="create_part" class="r1">
                <h3>1-A propos de l'événement</h3>

                <div class="centre">

                        <div class="label">
                            <label for='nom'>Nom*  </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='nom' id='nom' maxlength="12" required placeholder="ex : Mon evenement">
                    </div>
                        <div class="label">
                        <label for='mail'>Theme*  </label>
                        </div>
                    <div class="fill">
                        <select  name='theme' id='theme'>
                            <optgroup label='Musique'/>
                                <option value='classique'>Classique</option>
                                <option value='metal'>Metal</option>
                                <option value='rock'>Rock</option>
                                <option value='autres_m'>Autres</option>
                            <optgroup label='Cinema'/>
                                <option value='action'>Action</option>
                                <option value='thriller'>Thriller</option>
                                <option value='familial'>Familial</option>
                                <option value='comedie'>Comedie</option>
                                <option value='autres_c'>Autres</option>
                            <optgroup label='Image'/>
                                <option value='peinture'>Peinture</option>
                                <option value='photographie'>Photographie</option>
                                <option value='autres_i'>Autres</option>
                        </select>
                    </div>
                         <div class="label">
                        <label for='type'>Type*  </label>
                         </div>
                    <div class="fill">
                        <select  name='type' id='type'>
                                <option value='expo'>Exposition</option>
                                <option value='projection'>Projection</option>
                                <option value='conf'>Conference</option>
                                <option value='concert'>Concert</option>
                                <option value='projection'>Projection</option>
                                <option value='autres_ty'>Autres</option>
                        </select>
                    </div>
                    <br>
                    <!--les champs ne marchent pas pour firefox d'où le placeholder...-->
                         <div class="label">
                        <label for='date_de'>Début*  </label>
                         </div>
                    <div class="fill">
                        <input type="date" name="date_de" id="date_de" required placeholder="dd/mm/yyyy">
                        <input type="time" name="time_de" id="time_de" required placeholder="hh/mm">
                    </div>
                         <div class="label">
                        <label for='date_fi'>Fin*  </label>
                         </div>
                    <div class="fill">
                        <input type="date" name="date_fi" id="date_fi" required placeholder="dd/mm/yyyy">
                        <input type="time" name="time_fi" id="time_fi" required placeholder="hh/mm">
                    </div>
                    <br>
                         <div class="label">
                        <label for='nbpl'>Capacité*  </label>
                         </div>
                    <div class="fill">
                        <input type="number" name="nbpl" id="nbpl" required min="2" placeholder="10">
                    </div>
                         <div class="label">
                        <label for='price'>Prix (euros)*  </label>
                         </div>
                    <div class="fill">
                        <input type="number" name="price" id="price" required min="0" placeholder="0">

                    </div>
                        <div class="label">
                            <label for='mclef'>Mots clefs  </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='mclef' id='mclef' maxlength="100" placeholder="motclef1, motclef2, motclef3...">
                    </div>
                    <br>
                    <p><input type='checkbox' name='priv' id='priv'/>

                     <label for='priv'>Privé</label></p>
                </div>
                <br>
                </div>
                <div class="create_part2">
                    <h3>2-Paramètres d'inscription (si événement privé)</h3>
                <div class="centre">

                        <div class="label">
                            <label for='gpadm'>Groupes admis  </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='gpadm' id='gpadm'  placeholder="groupe1, groupe2, groupe3...">
                    </div>

                        <div class="label">
                            <label for='padm'>Personnes admises  </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='padm' id='padm'  placeholder="personne1, personne2, personne3...">
                    </div>
                </div>
                <br>
                </div>
                 <div class="create_part">
                    <h3>3-Black list</h3>
                <div class="centre">

                        <div class="label">
                            <label for='blist'>Personnes non admises  </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='blist' id='blist' placeholder="personne1, personne2, personne3...">
                    </div>
                </div>
                <br>
                 </div>
                 <div class="create_part2">
                    <h3>4-Organisateur</h3>
                <div class="centre">

                       
                        <div class="label">
                                <label for='partn'>Partenaires et Sponsors </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='partn' id='partn' placeholder="partenaire1, partenaire2, sponsor1...">
                    </div>

                        <div class="label">
                                <label for='weborg'>Site internet </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='weborg' id='weborg' placeholder="wwww.exemple.com">
                    </div>
                </div>
                <br>
                 </div>
                 <div class="create_part">
                    <h3>5-Lieu</h3>
                <div class="centre">
                         <div class="label">
                        <label for='reg'>Région*  </label>
                         </div>
                    <div class="fill">
                        <select  name='reg' id='reg'>
                                <option value='r1'>R1</option>
                                <option value='r2'>R2</option>
                        </select>
                    </div>

                        <div class="label">
                                <label for='adr'>Adresse*  </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='adr' id='adr' required placeholder="14 rue event">
                    </div>
                         <div class="label">
                        <label for='code_p'>Code postal*  </label>
                         </div>
                    <div class="fill">
                        <input type="text" name="code_p" id="code_p" required minlength=5 maxlength="5" placeholder="00000">
                    </div>
                         <div class="label">
                        <label for='ville'>Ville*  </label>
                         </div>
                    <div class="fill">
                        <input type="text" name="ville" id="ville" required placeholder="Paris">
                    </div>
                         <div class="label">
                        <label for='pays'>Pays*  </label>
                         </div>
                    <div class="fill">
                        <select  name='pays' id='reg'>
                                <option value='fr'>France</option>
                                <option value='cn'>Canada</option>
                        </select>
                    </div>
                </div>
                <br>
                 </div>
                 <div class="create_part2">
                    <h3>6-Page de l'événement</h3>
                <div class="centre">



                            <label for='descript'>Description  </label>




                            <br>

                        <textarea required name="descript" rows=10 cols=100>Bla bla bla </textarea>

                    <br>

                            <label for='bann'>Bannière  </label>


                        <input required type="file" id="bann" name="bann">
                        <p class='gauche'>Dimensions : 400px*900px</p>

                        <!--mettre les vrais dimensions-->

                    <p>
					<input type='checkbox' name='sujet' id='sujet'/>
                     <label for='sujet'>Créer un sujet dans le forum</label>
					 </p>
                </div>
                <br>
                </div>
                 <div class="create_part">
                    <h3>7-Invitation à l'événement</h3>
                <div class="centre">

                        <div class="label">
                            <label for='invitm'>Envoyer un e-mail d'invitation à  </label>
                        </div>
                        <br>
                        <textarea name="invitm" rows=10 cols=100>invite@gmail.com, invite3@gmail.com ...</textarea>

                </div>
                 </div>
                 <p><input type='checkbox' name='condi' id='condi' required/>
                     <label for='condi'>J'accepte les conditions d'utilisation du site... *</label></p>
                 <br>
                 <p class="gauche">* : champs obligatoires</p>
                 <!--Mettre différentes fonctions à chaque bouton -->
                 <p><input id="bouton" type='submit' value='Envoyer'/>
                    <input id="bouton" type='submit' value='Enregistrer sans sauvegarder'/>
                    <input id="bouton" type='submit' value='Annuler'/></p>
            </form>
        </section>
