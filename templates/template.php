<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Event-You-All | Home page</title>
  <link href="<?php echo Config::get('config.base') ; ?>/librairies/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Config::get('config.base') ; ?>/librairies/normalize/normalize.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Config::get('config.base') ; ?>/templates/styles/style.css" rel="stylesheet" type="text/css" />
  <?php echo $app_rendered['css']; ?>
</head>

<body>
  <div class="fluid-wrapper">
    <div class="main-head">
      <header>
        <div class="socials">
        </div>
        <img src="<?php echo Config::get('config.base') ;?>/templates/images/header/logo.png" alt="Event-You-All logo" class="logo">
        <?php
          $session = System::getSession();
        ?>
        <div class="login<?php $session->isConnected() ? ' connected' : ''; ?>">
          <?php
            if ($session->isConnected()) {
          ?>
            Bienvenue <?php echo $_SESSION['nickname']; ?>
            <br><br>
            <a href="<?php echo Config::get('config.base'); ?>/user/my_account">Mon compte</a> - <a href="<?php echo Config::get('config.base'); ?><?php echo Config::get('config.base'); ?>/user/logout">Se déconnecter</a>
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
          <form action="/search" method="POST">
            <p>
              <button type="submit" name="submit">
                <i class="fa fa-search"></i>
              </button>
              <input type="search" name="search" id="search" placeholder="Recherche">
            </p>
          </form>
        </li>
      </ul>
    </nav>
    <section class="main-content">
      <?php echo $app_rendered['tpl']; ?>
    </section>
    <footer>
      <nav class="main-navigation">
      <ul>
        <li><a href="home.html">Accueil</a></li>
        <li><a href="home.html">Thèmes</a></li>
        <li><a href="home.html">Articles</a></li>
        <li><a href="home.html">Forum</a></li>
        <li><a href="home.html">FAQ</a></li>
        <li><a href="home.html">Contact</a></li>
        <li><a href="home.html">A propos de nous</a></li>
      </ul>
    </nav>
    </footer>
  </div>
  <?php echo $app_rendered['js']; ?>
</body>
</html>
