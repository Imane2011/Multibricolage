<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
// on verifie si l'utilisateur est connécté
if (!isset($_SESSION['id'])) {
    //redirige vers la page de connexion s'il n'est pas connecté
    header("Location: index.php?route=connexion");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <link rel="stylesheet" href="assets/css/interface_adminCSS/admin.css">
    <link rel="stylesheet" href="assets/css/interface_adminCSS/header_dsh.css">
</head>
<body>
    <header>
        <div class="menuDesktop">
            <div class="logo"><a href="admin.php"><img src="assets/img/Média-removebg-preview.png" alt="logo"></a></div>
            <nav class="desktop">
                <ul class="menu">
                    <li class="navbarList"><a href="?route=admin">Accueil</a></li>
                    <li class="navbarList"><a href="?route=services_dsh">Services</a></li>
                    <li class="navbarList"><a href="?route=realisations_dsh">Réalisations</a></li>
                    <!-- <li class="navbarList"><a href="../assets/php/deconnexion.php">Déconnexion</a></li> -->
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
                <a href="assets/php/deconnexion.php">Déconnexion</a>
            </nav>
        </div>
    </header>

    <main>
        <section classe="titre">
        <form  action="assets/php/deconnexion.php" method="post">
        <button class="btnDeconnexion" name="submitDeconnexion" type="submit">Déconnexion</button>
       </form>
        <h1>Bienvenue dans l'Interface Admin</h1>
        </section>
        
        <section class="dashboard">
            <div class="card">
                <h2> Services</h2>
                <a href="?route=services_dsh" class="btn">Gérer les Services</a>
            </div>
            <div class="card">
                <h2>Réalisations</h2>
                <a href="?route=realisations_dsh" class="btn">Gérer les Réalisations</a>
            </div>
            
        </section>
    </main>

    <script src="assets/js/burger.js"></script>
</body>
</html>