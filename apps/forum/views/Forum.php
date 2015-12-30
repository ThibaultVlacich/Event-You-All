
  </div>
        <ul id="haut">

            <a href="#" class="titreenteteforum"><li class="enteteforum">Créer un nouveau Topic</li></a>
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
            <thead>
                <tr class="titresujet">
                    <th class="sujetth">Sujet</th>
                    <th class="adminth">Administrateur</th>
                    <th class="eventth">Evenement</th>
                    <th class="dateth">Date de création</th>
                </tr>
            </thead>
              <?php foreach($model['topics'] as $topic) { ?>
            <tr>
                <td class="sujet"><?php echo $topic['titre']; ?></td>
                <td class="admin"><?php echo $topic['administrateur'];?></td>
                <td class="event">super concert</td>
                <td class="date"><?php echo $topic['date_creation'];?></td>
            </tr>
            <?php } ?>
        </table>
