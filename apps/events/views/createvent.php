        <section class="blocinscri">
            <form method='post' action='<?php echo Config::get('config.base'); ?>/events/create_confirm' enctype="multipart/form-data">
                <h2>Créer un nouvel événement</h2>
              <div class="create_part" class="r1">
                <h3>1-A propos de l'événement</h3>

                <div class="centre">

                        <div class="label">
                            <label for='nom'>Nom<span class="required">*</span>  </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='nom' id='nom'  required placeholder="ex : Mon evenement">
                    </div>
                        <div class="label">
                        <label for='mail'>Theme<span class="required">*</span>  </label>
                        </div>
                    <div class="fill">
                        <select  name='theme' id='theme'>
                            <optgroup label='Musique'/>
                                <option value=1>Classique</option>
                                <option value=2>Metal</option>
                                <option value=3>Rock</option>
                                <option value=4>Autres</option>
                            <optgroup label='Cinema'/>
                                <option value=5>Action</option>
                                <option value=6>Thriller</option>
                                <option value=7>Familial</option>
                                <option value=8>Comedie</option>
                                <option value=9>Autres</option>
                            <optgroup label='Image'/>
                                <option value=10>Peinture</option>
                                <option value=11>Photographie</option>
                                <option value=12>Autres</option>
                        </select>
                    </div>
                         <div class="label">
                        <label for='type'>Type<span class="required">*</span>  </label>
                         </div>
                    <div class="fill">
                        <select  name='type' id='type'>
                                <option value=1>Exposition</option>
                                <option value=2>Projection</option>
                                <option value=3>Conference</option>
                                <option value=4>Concert</option>
                                <option value=5>Projection</option>
                                <option value=5>Autres</option>
                        </select>
                    </div>
                    <br>
                    <!--les champs ne marchent pas pour firefox d'où le placeholder...-->
                         <div class="label">
                        <label for='date_de'>Début<span class="required">*</span>  </label>
                         </div>
                    <div class="fill">
                        <input type="date" name="date_de" id="date_de" required placeholder="dd/mm/yyyy">
                        <input type="time" name="time_de" id="time_de" required placeholder="hh/mm">
                    </div>
                         <div class="label">
                        <label for='date_fi'>Fin<span class="required">*</span>  </label>
                         </div>
                    <div class="fill">
                        <input type="date" name="date_fi" id="date_fi" required placeholder="dd/mm/yyyy">
                        <input type="time" name="time_fi" id="time_fi" required placeholder="hh/mm">
                    </div>
                    <br>
                         <div class="label">
                        <label for='nbpl'>Capacité<span class="required">*</span>  </label>
                         </div>
                    <div class="fill">
                        <input type="number" name="nbpl" id="nbpl" required min="2" placeholder="10">
                    </div>
                         <div class="label">
                        <label for='price'>Prix (euros)<span class="required">*</span>  </label>
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
                        <label for='reg'>Région<span class="required">*</span>  </label>
                         </div>
                    <div class="fill">
                        <select  name='reg' id='reg'>
                                <option value='r1'>R1</option>
                                <option value='r2'>R2</option>
                        </select>
                    </div>

                        <div class="label">
                                <label for='adr'>Adresse<span class="required">*</span>  </label>
                        </div>
                    <div class="fill">
                        <input type='text' name='adr' id='adr' required placeholder="14 rue event">
                    </div>
                         <div class="label">
                        <label for='code_p'>Code postal<span class="required">*</span>  </label>
                         </div>
                    <div class="fill">
                        <input type="text" name="code_p" id="code_p" required minlength=5 maxlength="5" placeholder="00000">
                    </div>
                         <div class="label">
                        <label for='ville'>Ville<span class="required">*</span>  </label>
                         </div>
                    <div class="fill">
                        <input type="text" name="ville" id="ville" required placeholder="Paris">
                    </div>
                         <div class="label">
                        <label for='pays'>Pays<span class="required">*</span>  </label>
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


                        <input type="file" id="bann" name="bann">
                        <p class='gauche'>Dimensions : 400px*900px</p>

                        <!--mettre les vrais dimensions-->
                        
                        <label for='poster'>Poster  </label>


                        <input type="file" id="poster" name="poster">
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
                     <label for='condi'>J'accepte les conditions d'utilisation du site... <span class="required">*</span></label></p>
                 <br>
                 <p class="gauche"><span class="required">*</span> : champs obligatoires</p>
                 <!--Mettre différentes fonctions à chaque bouton -->
                 <p><input id="bouton" type='submit' value='Envoyer'/>
                    <input id="bouton" type='submit' value='Enregistrer sans publier'/>
                    <input id="bouton" type='submit' value='Annuler'/></p>
            </form>
        </section>
