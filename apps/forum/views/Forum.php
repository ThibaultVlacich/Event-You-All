<!DOCTYPE html>
<html>
    <head>
        <title>Forum accueil</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="cssForum.css"/>
    </head>
    <body>
  </div>
        <ul id="haut">

            <li class="enteteforum"><a href="#" class="titreenteteforum">Créer un nouveau Topic</a></li>
            <li class="enteteforum"><a href="#" class="titreenteteforum">Mes Topics</a></li>
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
            <tr>
                <td class="sujet">Sujet</td>
                <td class="admin">Mr.a</td>
                <td class="event">super concert</td>
                <td class="date">10/11/2015</td>
            </tr>
            <tr>
                <td class="sujet">Sujet</td>
                <td class="admin">Mr.a</td>
                <td class="event">super concert</td>
                <td class="date">10/11/2015</td>
            </tr>
            <tr>
                <td class="sujet">Sujet</td>
                <td class="admin">Mr.a</td>
                <td class="event">super concert</td>
                <td class="date">10/11/2015</td>
            </tr>
        </table>
        <table id="num_page">
            <tr>
                <td><a href="#">1</a></td>
                <td><a href="#">2</a></td>
                <td><a href="#">3</a></td>
            </tr>
        </table>
    </body>
</html>
