<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo !empty($app_rendered['title']) ? $app_rendered['title'] : Config::get('config.site_title'); ?>
  </title>
  <link href="<?php echo Config::get('config.base') ; ?>/librairies/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Config::get('config.base') ; ?>/librairies/normalize/normalize.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Config::get('config.base') ; ?>/templates/styles/style.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Config::get('config.base') ; ?>/templates/styles/responsive.css" rel="stylesheet" type="text/css" />
  <?php echo $app_rendered['css']; ?>
</head>

<body>
  <div class="fluid-wrapper">
    <div class="main-head">
      <header>
        <div class="socials">
          <a href="https://facebook.com/Event-You-All" target="_blank"><i class="fa fa-facebook-square"></i></a>
          <a href="https://twitter.com/Event-You-All" target="_blank"><i class="fa fa-twitter-square"></i></a>
        </div>
        <a href="<?php echo Config::get('config.base'); ?>">
          <img src="<?php echo Config::get('config.base') ;?>/templates/images/header/logo.png" alt="Event-You-All logo" class="logo">
        </a>
        <?php
          $session = System::getSession();
        ?>
        <div class="login<?php echo $session->isConnected() ? ' connected' : ''; ?>">
          <?php
            if ($session->isConnected()) {
          ?>
            Bienvenue <?php echo $_SESSION['nickname']; ?>
            <br><br>
            <a href="<?php echo Config::get('config.base'); ?>/user/my_account">Mon compte</a> - <a href="<?php echo Config::get('config.base'); ?>/user/logout">Se déconnecter</a>
            <?php if($_SESSION['access'] == 3) { ?><br><a href="<?php echo Config::get('config.base'); ?>/admin">Accéder à l'administration</a><?php } ?>
          <?php
            } else {
          ?>
            <a href="<?php echo Config::get('config.base'); ?>/user/login" class="button">Se connecter</a>
            <a href="<?php echo Config::get('config.base'); ?>/user/register" class="button">S'inscrire</a>
          <?php
            }
          ?>
        </div>
      </header>
    </div>
    <nav class="main-navigation">
      <ul>
        <li><a href="<?php echo Config::get('config.base') ;?>">Accueil</a></li>
        <li><a href="<?php echo Config::get('config.base') ;?>/events/themes">Thèmes</a></li>
        <li><a href="<?php echo Config::get('config.base') ;?>/news">Articles</a></li>
        <li><a href="<?php echo Config::get('config.base') ;?>/forum">Forum</a></li>
        <li class="search">
          <form action="<?php echo Config::get('config.base'); ?>/search/basicsearch" method="GET">
            <p>
              <button type="submit" name="submit">
                <i class="fa fa-search"></i>
              </button>
              <input type="search" name="search" id="search" placeholder="Recherche">
            </p>
          </form>
        </li>
      </ul>
      <div class="mobile">
      	<i class="hamburger fa fa-bars"></i>
        <i class="login fa fa-user"></i>
        <i class="search fa fa-search"></i>
        <ul class="mobile-menu">
          <li><a href="<?php echo Config::get('config.base') ;?>">Accueil</a></li>
          <li><a href="<?php echo Config::get('config.base') ;?>/events/themes">Thèmes</a></li>
          <li><a href="<?php echo Config::get('config.base') ;?>/news">Articles</a></li>
          <li><a href="<?php echo Config::get('config.base') ;?>/forum">Forum</a></li>
        </ul>
        <ul class="mobile-login">
          <?php
            if ($session->isConnected()) {
          ?>
            <li>Bienvenue <?php echo $_SESSION['nickname']; ?></li>
            <li><a href="<?php echo Config::get('config.base'); ?>/user/my_account">Mon compte</a></li>
            <li><a href="<?php echo Config::get('config.base'); ?>/user/logout">Se déconnecter</a></li>
            <?php if($_SESSION['access'] == 3) { ?><li><a href="<?php echo Config::get('config.base'); ?>/admin">Administration</a></li><?php } ?>
          <?php
            } else {
          ?>
            <li><a href="<?php echo Config::get('config.base'); ?>/user/login" class="button">Se connecter</a></li>
            <li><a href="<?php echo Config::get('config.base'); ?>/user/register" class="button">S'inscrire</a></li>
          <?php
            }
          ?>
        </ul>
        <div class="mobile-search">
          <form action="<?php echo Config::get('config.base'); ?>/search/basicsearch" method="GET">
            <p>
              <input type="search" name="search" id="search" placeholder="Recherche...">
              <button type="submit" name="submit">
                <i class="fa fa-search"></i>
              </button>
            </p>
          </form>
        </div>
      </div>
    </nav>
    <section class="main-content">
      <?php echo $app_rendered['tpl']; ?>
    </section>
    <footer>
      <nav class="main-navigation">
        <ul>
          <li><a href="<?php echo Config::get('config.base') ; ?>">Accueil</a></li>
          <li><a href="<?php echo Config::get('config.base') ; ?>/events/themes">Thèmes</a></li>
          <li><a href="<?php echo Config::get('config.base') ; ?>/articles">Articles</a></li>
          <li><a href="<?php echo Config::get('config.base') ; ?>/forum">Forum</a></li>
          <li><a href="<?php echo Config::get('config.base') ; ?>/faq">FAQ</a></li>
          <li><a href="<?php echo Config::get('config.base') ; ?>/contact">Contact</a></li>
          <li><a href="<?php echo Config::get('config.base') ; ?>/about">A propos de nous</a></li>
        </ul>
      </nav>
    </footer>
  </div>
  <div id="cookie-notice">
    Nous utilisons des cookies pour vous garantir la meilleure expérience sur notre site. Si vous continuez à utiliser ce dernier, nous considérerons que vous acceptez l'utilisation des cookies.
    <a href="#" class="accept-button">Ok</a>
  </div>
  <script type="text/javascript" src="<?php echo Config::get('config.base'); ?>/librairies/jquery-2.1.4/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="<?php echo Config::get('config.base'); ?>/templates/scripts/global.js"></script>
  <?php echo $app_rendered['js']; ?>
</body>
</html>
