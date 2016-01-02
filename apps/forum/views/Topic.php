
        <ul id="haut">
            <li><a href="<?php echo Config::get('config.base');?>/forum/create">Créer un nouveau Topic</a></li>
            <li><a href="#">Mes Topics</a></li>
            <li><form method="post" action="hey.php">
                <label for="recherche">Rechercher sur le forum</label>
                <input type="search" placeholder="ex: Photographie" id="recherche" name="recherche"/>
                </form></li>
        </ul>
        <?php
          if (empty($model)) {
            // No topic based on asked id
        ?>
        <div class="note error">
          <i class="fa fa-exclamation-triangle"></i>
          <ul>
            <li>Le sujet demandé n'existe pas !</li>
          </ul>
        </div>
        <?php
            return;
          }
        ?>

        <ul id="presentation">
            <li><p>Sujet de :</p></li>
            <li><h3><?php echo $model['administrateur']; ?></h3></li>
            <li><p>Crée le :</p></li>
            <li><h3><?php echo $model['date_creation']; ?></h3></li>
        </ul>
        <ul id="titre">
            <li><p>sujet :</p></li>
            <li><div><h1><?php echo $model['titre']; ?></h1></div></li>
        </ul>
        <table class="first_ligne">
            <tr>
                <td class="utilisateur">
                    <h4>Utilisateur</h4>
                </td>
                <td class="date">
                    <h4>Date</h4>
                </td>
                <td class="com">
                    <h4 class="p_commentaire">Commentaire</h4>
                </td>
            </tr>
            <?php $i=1; ?>
            <?php foreach($model['comments'] as $comment) { ?>
        </table>
        <table <?php if(i%2==0){?>class="back2" <?php } else {?>class="back1"<?php } ?>>
            <tr>
                <td class="utilisateur">
                    <h4><?php echo $comment['createur']; ?></h4>
                </td>
                <td class="date">
                    <p><?php echo $comment['date']; ?></p>
                </td>
                <td class="com">
                    <p class="p_commentaire"><?php echo $comment['message']; ?></p>
                </td>
            </tr>
            <?php $i=$i+1; } ?>
        <table id="num_page">
            <tr>
                <td><a href="#">1</a></td>
                <td><a href="#">2</a></td>
                <td><a href="#">3</a></td>
            </tr>
        </table>
        <input id="AJ_txt" type="textarea" placeholder="Ajouter un commentaire"/>
        <input class="Envoyer" type="submit" value="Envoyer">
