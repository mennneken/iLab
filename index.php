<?php 
    // Chargement des librairies via Composer
  require('vendor/autoload.php');
  // Chargement du SDK
  require('heajsdk/src/client.php');
  
  // Configuration du SDK
  $clientId = 2;
  $clientSecret = 'zy7hsxYcpT6BxiyP0O0BRh68ajwczGEOgu3h7Z35';
  $sdk = new HEAJSDK($clientId, $clientSecret);
  $login = $_POST["id"];
  $password = $_POST["password"];

  if($_POST['public'] == "Mode public"){
    header('Location: technique.html');
  }
  if(!empty($login) && (!empty($password))){
    if($sdk->login("$login", "$password")){
      header('Location: horaire.html');
    } else {
      $error =  "<p class='error'>".'votre login ou mot de passe est incorrect.'."</p>";
    }
  }

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Valves Numériques de la Haute École Albert Jacquard">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Valves Numériques | HEAJ</title>

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Web Application Manifest -->
    <link rel="manifest" href="manifest.json">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Valves Numériques HEAJ">
    <link rel="icon" sizes="192x192" href="images/touch/chrome-touch-icon-192x192.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Valves Numériques HEAJ">
    <link rel="apple-touch-icon" href="images/touch/apple-touch-icon.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#EB302E">

    <!-- Color the status bar on mobile devices -->
    <meta name="theme-color" content="#EB302E">

    <!-- Styles -->
    <link rel="stylesheet" href="styles/main.css">
  </head>
  <body>

    <header class="header header--main-page">
      <div class="header__left">
      </div>
      <div class="header__center">
        <h1 class="page-title page-title--logo">
          <img class="logo logo--title" src="images/logo-heaj.svg" alt="Logo HEAJ">
        </h1>
      </div>
      <div class="header__right"></div>
    </header>

    <main>
      <section class="container login">
        <h2>Se connecter</h2>
        
        <form class="" method="post">
          <div class="form__group">
            <input class="card input input--field" type="text" name="id" placeholder="Identifiant">
          </div>
          <div class="form__group">
            <input class="card input input--field input--pass" type="password" name="password" placeholder="Mot de Passe">
            <a class="link link--forget-pass" href="#">Mot de passe oublié ?</a>
            <?php if(!empty($error)) echo $error; ?>
          </div>
          
          <div class="form__group">
            <input class="card input input--submit input--log-in" type="submit" value="Connexion">
            <input class="card input input--submit input--log-off" type="submit" value="Mode public" name="public">
          </div>
        </form>
      </section>
    </main>

    <!-- build:js scripts/main.min.js -->
    <script src="scripts/main.js"></script>
    <!-- endbuild -->
  </body>
</html>
