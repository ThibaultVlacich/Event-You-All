<h2 id='titre' >Evénements</h2>

<form id="nb" method="get" action="<?php echo Config::get('config.base'); ?>/admin/events">
    <input type="number" name="number" placeholder="page n°" min="1">
    <select name="times">
        <option value="10">10</option>
        <option value="30">30</option>
        <option value="60">60</option>
        <option value="100000000">All</option>
    </select>
    <input id='hide'type="submit" />
</form>

<table id='resultat'> <tr><th></th><th>Début</th> <th>Nom</th> <th>Créateur</th> <th>Theme</th><th>Type</th><th></th></tr>
<tr>
    <?php foreach ($model['events'] as $value)
        {?>
        <tr>
        <td>
            <a href='<?php echo Config::get('config.base'); ?>/admin/events/modif/<?php echo $value['id']; ?>'>Modifier</a>
        </td>
        <td>
            <?php echo $value['date_debut'];?>
        </td>
        <td>
            <a class='discret' href='<?php echo Config::get('config.base'); ?>/events/detail/<?php echo $value['id']; ?>'>
            <?php echo $value['nom'];?> </a>
        </td>
        <td>
            <a class='discret' href='<?php echo Config::get('config.base'); ?>/users/<?php echo $value['id_createur']; ?>'>
            <?php echo $value['createur']['nickname'];?> </a>
        </td>
        <td>
            <?php echo $value['theme']['nom'];?>
        </td>
        <td>
            <?php echo $value['type']['nom'];?>
        </td>
        <td>
            <a href='<?php echo Config::get('config.base'); ?>/admin/events/delete/<?php echo $value['id']; ?>'
            onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet événement ?'));">Effacer</a>
        </td>
</tr>
        
        
        <?php } ?>
</table>