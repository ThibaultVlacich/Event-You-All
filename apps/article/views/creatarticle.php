﻿<!DOCTYPE html>
<!--
A faire : - changer le lien html vers connexion
          - inserrer la page dans le design du site (header, footer) et centrer le block
-->
<html>
    <head>
        <title>Event-You-All /Creation Article</title> <!-- changer le / en baton droit -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="creatarticle.css"/>
    </head>
    <body>
        <!--haut page-->
        <!-- pb : lorsqu'on réduit la fenêtre les champs -->
        <section class="blocinscri">
            <form method='post' action='truc.php' >
                <h2>Ecrire un article</h2>
                <h3>1-A propos de l'Article</h3>
                <div class="centre">
                    <div class="long">
                        <div class="label">
                            <label for='nom'>Nom*  </label>
                        </div>
                        <input type='text' name='nom' id='nom' maxlength="12" required placeholder="ex : Mon evenement">
                    </div>
                    <div class="long">
                        <div class="label">
                            <label for='type'>Type*  </label>
                        </div>
                        <select  name='type' id='type'>
                                <option value='bilan'>Bilan</option>
                                <option value='autres_type'>Autres</option>
                        </select>
                    </div>
                    <!--<div class="long">
                        <div class="label">
                            <label for='mail'>Theme*  </label>
                        </div>
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
                    </div>-->
                    <div class="long">
                        <div class="label">
                            <label for='mclef'>Mots clefs  </label>
                        </div>
                        <input type='text' name='mclef' id='mclef' maxlength="100" placeholder="motclef1, motclef2, motclef3...">
                    </div>
                    <br>
                    <div class="long">
                        <div class="label">
                            <label for='arti'>Article lié à mon événément  </label>
                        </div>
                            <select  name='arti' id='arti'>
                                <optgroup label='2016'>
                                    <option value='bilan'>Mon event 1</option>
                                    <option value='autres_type'>Mon event 2</option>
                            </select>
                    </div>
                </div>
                    <h3>2-Corps de l'Article</h3>
                <div class="centre">
                    <!--mettre des boutons d'edition style insertion d'images, caracteres en gras... -->
                    <div class="long">
                        <div class="label">
                            <label for='corps'>Article  </label>
                        </div>
                        <br>
                        <textarea required name="corps" rows=10 cols=100>Bla bla bla </textarea>
                    </div>
                    <div class="long">
                        <div class="label">
                            <label for='bann'>Bannière  </label>
                        </div>
                        <input required type="file" id="bann" name="bann">
                        <p class='gauche'>Dimensions : 400px*900px</p>
                        <!--mettre les vrais dimensions-->
                    </div>
                    <p><input type='checkbox' name='comm' id='infom' checked/> 
                     <label for='comm'>Autoriser les commentaires</label>                       
                     <input type='checkbox' name='nott' id='infom' checked/> 
                     <label for='nott'>Autoriser les notations</label></p>
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
        <!--bas page-->
    </body>
</html>