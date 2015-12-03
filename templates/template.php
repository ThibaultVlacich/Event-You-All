<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Event-You-All | Home page</title>
  <link rel="stylesheet" href="<?php echo Config::get('config.base') ; ?>/librairies/font-awesome-4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo Config::get('config.base') ; ?>/librairies/normalize/normalize.css">
  <link rel="stylesheet" href="<?php echo Config::get('config.base') ; ?>/templates/styles/style.css">
  <?php echo $app_rendered['css']; ?>
</head>

<body>
  <div class="fluid-wrapper">
    <header>
      <div class="socials"></div>
      <img src="<?php echo Config::get('config.base') ;?>/templates/images/header/logo.png" alt="Event-You-All logo" class="logo">
      <div class="login"></div>
    </header>
    <nav class="main-navigation">
      <ul>
        <li><a href="home.html">Accueil</a></li>
        <li><a href="home.html">Thèmes</a></li>
        <li><a href="home.html">Articles</a></li>
        <li><a href="home.html">Forum</a></li>
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
    <?php echo $app_rendered['tpl']; ?>
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
    </footer>
  </div>
  <?php echo $app_rendered['js']; ?>
</body>
</html>
