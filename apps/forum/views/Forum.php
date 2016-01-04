
  </div>
        <ul id="haut">

            <a class="titreenteteforum" href="<?php echo Config::get('config.base'); ?>/forum/create"><li class="enteteforum">Créer un nouveau Topic</li></a>
            <a href="#" class="titreenteteforum"><li class="enteteforum">Mes Topics</li></a>
            <li class="enteteforum"><form method="post" action="hey.php">
                <label for="recherche" >Rechercher sur le forum</label>
                <input type="search" placeholder="ex: Photographie" id="recherche" name="recherche"/>
                </form></li>
        </ul>
            <form id="Trier">
                <label for="tri">Trier Par :</label>
                <select name="tri" id="tri">
                    <option value="date">Date</option>
                    <option value="genre">Genre</option>
                    <option value="popularité">Popularité</option>
                    <option value="nom">Nom</option>
                </select>
            </form>
        <table id="forum">
            <thead id="label">
                <tr class="titresujet">
                    <th class="sujet">Titre</th>
                    <th class="description">Description</th>
                    <th class="admin">Administrateur</th>
                    <th class="date">Date de création</th>
                </tr>
            </thead>
              <?php foreach($model['topics'] as $topic) { ?>
            <tr>

                <td class="sujet"><a id="link_topic" href="#"><?php echo $topic['titre']; ?></a></td>
                <td class="description"><a id="link_topic" href="#"><?php echo $topic['description']; ?></a></td>
                <td class="admin"><a id="link_topic" href="#"><?php echo $model['createur'];?></a></td>
                <td class="date"><a id="link_topic" href="#"><?php echo $topic['date_creation'];?></a></td>

            </tr>
            <?php } ?>
        </table>
