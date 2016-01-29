<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo Config::get('config.site_title'); ?> - Administration
  </title>
  <link href="<?php echo Config::get('config.base') ; ?>/librairies/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Config::get('config.base') ; ?>/librairies/normalize/normalize.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Config::get('config.base') ; ?>/templates/styles/admin.css" rel="stylesheet" type="text/css" />
  <?php if (isset($app_rendered['css'])) echo $app_rendered['css']; ?>
</head>

<body>
  <div class="col-menu">
    <div class="top-logo">
      <a href="<?php echo Config::get('config.base'); ?>"><img src="<?php echo Config::get('config.base'); ?>/templates/images/header/logo.png" srcset="<?php echo Config::get('config.base'); ?>/templates/images/header/logo.png 1x, <?php echo Config::get('config.base'); ?>/templates/images/header/logo@2x.png 2x" alt="Event-You-All logo"></a>
    </div>

    <?php
    /**
     * Get the list of admin apps
     */
    $admin_apps = array();

    $apps = System::getAppsList();

    foreach ($apps as $app) {
      if (substr($app, 0, 5) == 'admin') {
        $app_name = substr($app, 6);

        if ($app_name != 'board') {

          switch($app_name) {
            case "about":
              $name = "&Agrave; propos";
              $icon = "info";
              break;

            case "article":
              $name = 'Articles';
              $icon = 'sticky-note';

              break;

            case "cgu":
              $name = 'Conditions générales d\'utilisation';
              $icon = 'legal';

              break;

            case "events":
              $name = '&Eacute;vénements';
              $icon = 'paint-brush';

              break;

            case 'faq':
             $name = 'Questions fréquentes';
             $icon = 'question';

             break;

            case "user":
              $name = 'Utilisateurs';
              $icon = 'users';

              break;

            default:
              $name = $app_name;
              $icon = '';
          }

          $app = array(
            'app-name' => $app_name,
            'name'     => $name,
            'icon'     => $icon
          );

          $admin_apps[] = $app;
        }
      }
    }

    if (!empty($admin_apps)) {
    ?>
    <ul class="apps-menu">
      <li<?php if($route['app'] == 'board' || empty($route['app'])) { echo ' class="active"'; } ?>>
        <a href="<?php echo Config::get('config.base'); ?>/admin" class="app-link">
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle-thin fa-stack-2x"></i>
            <i class="fa fa-dashboard fa-stack-1x"></i>
          </span>
          Tableau de bord
        </a>
      </li>
      <?php foreach ($admin_apps as $admin_app) { ?>
      <li<?php if($route['app'] == $admin_app['app-name']) { echo ' class="active"'; } ?>>
        <a href="<?php echo Config::get('config.base'); ?>/admin/<?php echo $admin_app['app-name']; ?>" class="app-link">
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle-thin fa-stack-2x"></i>
            <?php if (!empty($admin_app['icon'])) { ?><i class="fa fa-<?php echo $admin_app['icon']; ?> fa-stack-1x"></i><?php } ?>
          </span>
          <?php echo $admin_app['name']; ?>
        </a>
      </li>
      <?php } ?>
    </ul>
    <?php } ?>
  </div>

  <div class="col-content">
    <header class="page-head">
      <div class="toolbar-box">
        <button id="menu-toggle" title="Menu" class="btn btn-default hidden-lg hidden-md"><i class="fa fa-bars"></i></button>
      </div>
      <div class="pull-right">
        <?php
          $session = System::getSession();
          if ($session->isConnected()) {
        ?>
        <div class="userbox">
          <?php echo $_SESSION['nickname']; ?>
          <a href="<?php echo Config::get('config.base'); ?>/user/logout/" class="navbar-link"><i class="fa fa-sign-out"></i></a></li>
        </div>
        <?php } ?>
      </div>
      <div class="clearfix"></div>
    </header>
    <div class="content">
      <?php
        if ($app_rendered === false) {
      ?>
      <div class="note error">
        <i class="fa fa-exclamation-triangle"></i>
        <ul>
          <li>Vous n'avez pas accès à cette page !</li>
          <?php if (!$session->isConnected()) {?><li><a href="<?php echo Config::get('config.base'); ?>/user/login">Merci de vous connecter !</a><?php } ?>
        </ul>
      </div>
      <?php
        } else {
          echo $app_rendered['tpl'];
        }
      ?>
    </div>
  </div>
  <div class="clearfix"></div>
  <script type="text/javascript" src="<?php echo Config::get('config.base'); ?>/librairies/jquery-2.1.4/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="<?php echo Config::get('config.base'); ?>/templates/scripts/admin.js"></script>
  <?php if (isset($app_rendered['js'])) echo $app_rendered['js']; ?>
</body>
</html>
