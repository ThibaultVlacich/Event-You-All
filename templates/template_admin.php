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
  <?php echo $app_rendered['css']; ?>
</head>

<body>
  <div class="col-menu">
    <div class="top-logo">
      <a href="<?php echo Config::get('config.base') ; ?>"><img src="<?php echo Config::get('config.base') ; ?>/templates/images/header/logo.png" alt="" /></a>
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
  			  $admin_apps[] = $app_name;
        }
  		}
  	}

    if (!empty($admin_apps)) {
    ?>
    <ul class="apps-menu">
      <li<?php if($route['app'] == 'Board') { echo ' clas="active"'; } ?>>
        <a href="<?php echo Config::get('config.base'); ?>/admin/board" class="app-link">
          <span class="icon" style="background-image: url(<?php echo Config::get('config.base'); ?>/apps/board/icon.png)"></span> Tableau de bord
        </a>
      </li>
      <?php foreach ($admin_apps as $admin_app) { ?>
      <li<?php if($route['app'] == $admin_app) { echo ' clas="active"'; } ?>>
        <a href="<?php echo Config::get('config.base'); ?>/admin/<?php echo $admin_app; ?>" class="app-link">
          <span class="icon" style="background-image: url(<?php echo Config::get('config.base'); ?>/apps/<?php echo $admin_app; ?>/icon.png)"></span> <?php echo ucfirst($admin_app); ?>
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
      <?php echo $app_rendered['tpl']; ?>
    </div>
  </div>
  <div class="clearfix"></div>
  <script type="text/javascript" src="<?php echo Config::get('config.base'); ?>/librairies/jquery-2.1.4/jquery-2.1.4.min.js"></script>
  <?php echo $app_rendered['js']; ?>
</body>
</html>
