<h1>Derniers Articles Ajoutés</h1>
<?php 
foreach($model as $art){?>
    <div class="resultat">

    <a class="link" href="<?php echo Config::get('config.base'); ?>/article/detail/<?php echo $art['id']; ?>">
    <?php echo $art['nom'];?>
    </a>
    <p>
     <?php echo substr($art['contenu'],0,500) ; if (strlen($art['contenu'])>500){echo '...';} ?>
    </p>

    </div>

<?php } ?>
