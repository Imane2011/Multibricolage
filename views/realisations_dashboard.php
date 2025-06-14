<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
// on verifie si l'utilisateur est connécté
if (!isset($_SESSION['id'])) {
    //redirige vers la page de connexion s'il n'est pas connecté
    header("Location: index.php?route=connexion");
    exit();
}
require("assets/php/db.php");
// Récupération des services
$sql = "SELECT * FROM page_realisations";
$req = $dbh->prepare($sql);
$req->execute();
$realisations = $req->fetchAll(PDO::FETCH_ASSOC);

// Ajout d'un nouveau service
if (isset($_POST['submit']) && !isset($_GET['action'])) {
  
    $admin_id = $_SESSION['id'];
    $image = $_FILES['image']['name'];
    $target = "assets/img/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO page_realisations (image, admin_id) VALUES (:image, :admin_id)";
        $req = $dbh->prepare($sql);
        $req->bindParam(':image', $target, PDO::PARAM_STR);
        $req->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        if ($req->execute()){
            header("Location:index.php?route=realisations_dsh");
            exit;
        }
        else{
            echo "Erreur lors de l'ajout de la réalisation";
        }
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}

// Modification
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM page_realisations WHERE id_realisation = :id_realisation";
    $req = $dbh->prepare($sql);
    $req->bindParam(':id_realisation', $id, PDO::PARAM_INT);
    $req->execute();
    $realisation = $req->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {
        $image = $_FILES['image']['name'];
        $target = "assets/img" . basename($image);

        if (!empty($image)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $sql = "UPDATE page_realisations SET image = :image WHERE id_realisation = :id_realisation";
        }

        $req = $dbh->prepare($sql);
        $req->bindParam(':id_realisation', $id, PDO::PARAM_INT);
        if (!empty($image)) {
            $req->bindParam(':image', $target, PDO::PARAM_STR);
        }

        if ($req->execute()) {
            header("location: index.php?route=realisations_dsh");
            exit();
            } else {
                echo "Erreur lors de la modification du realisation.";
        }
    }
}

// Suppression
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM page_realisations WHERE id_realisation = :id_realisation";
    $req = $dbh->prepare($sql);
    $req->bindParam(':id_realisation', $id, PDO::PARAM_INT);
    if ($req->execute()) {
        header("location: index.php?route=realisations_dsh");
        exit();
        } else {
            echo "Erreur lors de la suppression de la photo.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface Admin</title>
    <link rel="stylesheet" href="assets/css/interface_adminCSS/realisations_dsh.css">
    <link rel="stylesheet" href="assets/css/interface_adminCSS/header_dsh.css">
</head>
<body>
    <header>
         <div class=menuDesktop>
        <div class="logo"><a href="?route=admin"><img src="assets/img/Média-removebg-preview.png" alt="logo"></a></div>
        <nav class=desktop>
            <ul class="menu">
                <li class="navbarList"><a href="?route=admin">Accueil</a></li>
                <li class="navbarList"><a href="?route=services_dsh">Services</a></li>
                <li class="navbarList"><a href="?route=realisations_dsh">Réalisations</a></li>
    
            </ul>
         </nav>
    </div>
        

    <div class="menuMobile">
        <div class="burgerLogo" onclick="toggleMenu()">☰</div>
        <div class="burgerHiden" onclick="toggleMenu()" style="display:none">☒</div>
        <nav class="burger">
                <a href="?route=admin">Accueil</a>
                <a href="?route=services_dsh"Services></a>
                <a href="?route=realisations_dsh">Réalisation</a>        
         </nav>
            </div> 
    </header>

     <section classe="titre">
        <form  action="assets/php/deconnexion.php" method="post">
        <button class="btnDeconnexion" name="submitDeconnexion" type="submit">Déconnexion</button>
    </form>
    <h1>Gestion des Réalisations</h1>
    </section>

    <table>
        <thead>
            <tr>
     
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($realisations as $rls): ?>
                <tr>
                
                    <td><img src="<?= htmlspecialchars($rls['image']) ?>"></td>
                    <td>
                        <a class="btn" href="?route=realisations_dsh&action=edit&id=<?= $rls['id_realisation'] ?>"><img class="modifier" src="assets/img/modifier.png" alt="Modifier la réalisation"></a>
                        <a class="btn" onclick="return confirm('Confirmer la suppression ?');" href="?route=realisations_dsh&action=delete&id=<?= $rls['id_realisation'] ?>"><img class="effacer" src="assets/img/effacer.png" alt="Effacer la réalisation"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2><?= isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Modifier le service' : 'Ajouter un nouveau service' ?></h2>
    <form method="post" enctype="multipart/form-data">

        <label for="image">Image :</label><br>
        <input type="file" id="image" name="image" <?= isset($_GET['action']) && $_GET['action'] == 'edit' ? '' : 'required' ?>><br><br>

        <button type="submit" name="submit"><?= isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Modifier' : 'Ajouter' ?></button>
    </form>

</body>
</html>