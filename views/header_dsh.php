<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <link rel="stylesheet" href="assets/css/interface_adminCSS/admin.css">
    <link rel="stylesheet" href="assets/css/interface_adminCSS/services_dsh.css">
    <link rel="stylesheet" href="assets/css/interface_adminCSS/realisations_dsh.css">
    <link rel="stylesheet" href="assets/css/interface_adminCSS/header_dsh.css">
    <link rel="stylesheet" href="assets/css/interface_adminCSS/footer_dsh.css">
</head>
<body>
    <header>
        <div class="menuDesktop">
            <div class="logo"><a href="?route=admin"><img src="assets/img/logo.webp" alt="logo"></a></div>
            <nav class="desktop">
                <ul class="menu">
                    <li class="navbarList"><a href="?route=admin">Accueil</a></li>
                    <li class="navbarList"><a href="?route=services_dsh">Services</a></li>
                    <li class="navbarList"><a href="?route=realisations_dsh">Réalisations</a></li>
                    <form  action="assets/php/deconnexion.php" method="post">
                    <button class="btnDeconnexion" name="submitDeconnexion" type="submit">Déconnexion</button>
                    </form>
                </ul>
            </nav>
        </div>

        <div class="menuMobile">
            <div class="burgerLogo" onclick="toggleMenu()">☰</div>
            <div class="burgerHiden" onclick="toggleMenu()" style="display:none">☒</div>
            <nav class="burger">
                <a href="?route=admin">Accueil</a>
                <a href="?route=services_dsh">Services</a>
                <a href="?route=realisations_dsh">Réalisations</a>
                <form  action="assets/php/deconnexion.php" method="post">
                  <button class="btnDeconnexion" name="submitDeconnexion" type="submit">Déconnexion</button>
                 </form>
                
            </nav>
        </div>
    </header>