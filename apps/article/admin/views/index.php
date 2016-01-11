<h2 id='titre' >Articles</h2>

<form id="nb" method="get" action="<?php echo Config::get('config.base'); ?>/admin/events">
    <input type="number" name="number" placeholder="page n°" min='1'  value="<?php if (isset($model['number'])){echo $model['number'];} else {echo '1';}?>">
    <select name="times">
    <?php
     foreach (array('10','30','60','All') as $value) {
         if (isset($model['times']) and !empty($data['times'])){
             if ($value!='All'){
                 ?><option  value="<?php echo $value ?>" <?php if ($model['times']=$value){echo 'selected';}?>><?php echo $value ?></option><?php
             }
             else{
                 ?><option value="100000000000"><?php echo $value ?></option><?php
             }
         }
         else{
             if ($value!='All'){
                 ?><option value="<?php echo $value ?>"<?php if ($model['times']==100000000000){echo 'selected';}?>><?php echo $value ?></option><?php
             }
             else{
                 ?><option value="100000000000"><?php echo $value ?></option><?php
             }
         }
         
         
     }
    
    ?>
    </select>
    <input id='nohide'type="submit" />
</form>

<table id='resultat'> <tr><th></th><th>Création</th> <th>Nom</th> <th>Créateur</th> <th>Evenement lié</th><th></th></tr>
<tr>
    <?php foreach ($model['events'] as $value)
        {?>
        <tr>
        <td>
            <a href='<?php echo Config::get('config.base'); ?>/admin/article/modif/<?php echo $value['id']; ?>'>Modifier</a>
        </td>
        <td>
            <?php echo $value['date_creation'];?>
        </td>
        <td>
            <a class='discret' href='<?php echo Config::get('config.base'); ?>/article/detail/<?php echo $value['id']; ?>'>
            <?php echo $value['nom'];?> </a>
        </td>
        <td>
            <a class='discret' href='<?php echo Config::get('config.base'); ?>/users/<?php echo $value['id_createur']; ?>'>
            <?php echo $value['createur']['nickname'];?> </a>
        </td>
        <td>
            <?php echo $value['evenement']['nom'];?>
        </td>
        <td>
            <a href='<?php echo Config::get('config.base'); ?>/admin/article/delete/<?php echo $value['id']; ?>'
            onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet événement ?'));">Effacer</a>
        </td>
</tr>
        
        
        <?php } ?>
</table>