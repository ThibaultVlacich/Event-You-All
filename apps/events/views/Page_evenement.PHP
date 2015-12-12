
        <img src="http://www.institut-de-france.fr/sites/institut-de-france.fr/files/styles/diaporama/public/institut_900_320.jpg?itok=MAo-_W0J" id="imgevent" alt="image évènement"/>
    <section id="taille">
        <h1 id="titre"><?php echo($model['nom']); ?></h1>
        <section class="infoinitial">
            <div class="debutfin">
                <p>
                    Début : <?php echo($model['date_debut']); ?>
                </p>
                <p>
                    Fin : <?php echo($model['date_fin']); ?>
                </p>
            </div>
            <div class="statut">
                <p>
                    Statut : En Cours
                </p>
                <div class="bouton">
                <a href="n'existepas.com" class="topicforum">
                    Topic forum
                </a>
                </div>
            </div>
            <div class="placesprix">
                <p>
                    Nombre de places : <?php echo($model['capacite']); ?>
                </p>
                <p>
                    Prix : <?php echo($model['prix']); ?>
                </p>
            </div>
        </section>
        <section>
            <div class="description">
                <h1>Description</h1>
                <p>
                    <?php echo($model['description']); ?>
                </p>
            </div>
        </section>
            <div>
                <img src="<?php echo Config::get('config.base'); ?>/apps/events/images/petite_salle_institut.jpg" alt="diapo de photo" class="image"/>
            </div>
        <div class="adresse">
                <h2>
                    Adresse
                </h2>
                <p>
               <?php echo($model['adresse']); ?>
                </p>
            </div>
            <div class="text1">
                <ul>
               <li> <h2>Organisateur   </h2>
                <p class="organisateur">
                     Mr.A
                   </p></li>
               <li><h2>Téléphone   </h2>
                <p class="telephone">
                    0612345678
                   </p></li>
                <li><h2>Entreprise   </h2>
                <p class="entreprise">
                         blabla
                    </p></li>
                </ul>
                <div id="blanc">
                <ul>
                <li><h2>Site</h2>
                <p class="site">
                        <?php echo($model['site_web']); ?>
                    </p></li>
                <li><h2>Partenaire</h2>
                <p class="partenaire">
                        xxxxxxxxxxxxx
                    </p></li>
                </ul>
                </div>
            </div>
            <ul id="boutons">
                <li><div class="bouton">
                <a href="INCONNU.wtf" class="bouton">
                    S'incrire
                </a>
            </div>
            </li>
            <li><div class="bouton">
                <a href="TJRPAS.com">
                    Ajouter aux favoris
                </a>
            </div>
                </li>
                <li>
                <div class="bouton">
                <a href="...." >
                    Contacter par mail
                </a>
            </div>
                </li>
            </ul>
            <div>
                <p class="note">
                    Note moyenne :
                </p>
                <div class="bouton">
                <a href="rhnzearazer" class="badge">
                    Demander le badge
                </a>
                </div>
            </div>
        <section id="fin">
            <div class="article">
                <h1>
                    Article
                </h1>
                <p>
                    SKF (Svenska KullagerFabriken, littéralement: "Fabrique suédoise de roulements à billes") est un groupe multinational suédois, leader mondial dans le domaine du roulement mécanique. Son siège social se trouve à Göteborg1.

    Présent dans près de 70 pays, SKF emploie près de 43 000 personnes à travers le monde, pour un chiffre d'affaires de 61 milliards de couronnes suédoises en 2010 (soit 6,7 milliards d'euros).
                </p>
            </div>
            <div class="bouton" id="lire">
            <a href="zaerhzaeurhn">Lire plus  </a>
            </div>
            <div style="clear:both;"></div>
        </section>
        </section>
    </body>
</html>
