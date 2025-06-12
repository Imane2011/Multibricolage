<?php
//connexion à la BDD
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
// on verifie si l'utilisateur est connécté
if (!isset($_SESSION['id'])) {
    //redirige vers la page de connexion s'il n'est pas connecté
    header("Location: index.php?route=connexion");
    exit();
}
require("assets/php/db.php");
// Récupération des services
$sql = "SELECT * FROM services";
$req = $dbh->prepare($sql);
$req->execute();
$services = $req->fetchAll(PDO::FETCH_ASSOC);

// Ajout d'un nouveau service
if (isset($_POST['submit']) && !isset($_GET['action'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $target = "assets/img/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO services (titre, description, image) VALUES (:titre, :description, :image)";
        $req = $dbh->prepare($sql);
        $req->bindParam(':titre', $titre, PDO::PARAM_STR);
        $req->bindParam(':description', $description, PDO::PARAM_STR);
        $req->bindParam(':image', $target, PDO::PARAM_STR);
        if ($req->execute()) {
            echo "Service ajouté avec succès";
            header("Location: index.php?route=services_dsh");
            
            exit();
        }else{
            echo "Erreur lors de l'ajout du service";
        }

    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}

// Modification
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM services WHERE id = :id";
    $req = $dbh->prepare($sql);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $service = $req->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];

        $image = $_FILES['image']['name'];
        $target = "assets/img/" . basename($image);

        if (!empty($image)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $sql = "UPDATE services SET titre = :titre, description = :description, image = :image WHERE id = :id";
        } else {
            $sql = "UPDATE services SET titre = :titre, description = :description WHERE id = :id";
        }

        $req = $dbh->prepare($sql);
        $req->bindParam(':titre', $titre, PDO::PARAM_STR);
        $req->bindParam(':description', $description, PDO::PARAM_STR);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        if (!empty($image)) {
            $req->bindParam(':image', $target, PDO::PARAM_STR);
        }

        if ($req->execute()) {
            header("location: index.php?route=services_dsh");
            exit();
            } else {
                echo "Erreur lors de la modification du service.";
        }
    }
}

// Suppression
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM services WHERE id = :id";
    $req = $dbh->prepare($sql);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    if ($req->execute()){
        header("location: index.php?route=services_dsh");
        exit();
        } else {
            echo "Erreur lors de la suppression du service.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface Admin</title>
    <link rel="stylesheet" href="assets/css/interface_adminCSS/services_dsh.css">
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
                <a href="admin.php">Accueil</a>
                <a href="services_dashboard.php">Services</a>
                <a href="realisations_dashboard.php">Réalisation</a>        
         </nav>
            </div> 
    </header>
    <main>
         <section classe="titreServices">
        <form  action="assets/php/deconnexion.php" method="post">
        <button class="btnDeconnexion" name="submitDeconnexion" type="submit">Déconnexion</button>
        </form>
        <h1>Gestion des services</h1>
    </section>
    

    <table>
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Titre</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $srv): ?>
                <tr>
                  
                    <td><?= htmlspecialchars($srv['titre']) ?></td>
                    <td><?= htmlspecialchars($srv['description']) ?></td>
                    <td><img src="<?= htmlspecialchars($srv['image']) ?>" alt="<?= htmlspecialchars($srv['titre']) ?>"></td>
                    <td>
                        <a class="btn" href="?route=services_dsh&action=edit&id=<?= $srv['id'] ?>"><img class="modifier" src="assets/img/modifier.png" alt="Modifier le service"></a>
                        <a class="btn" onclick="return confirm('Confirmer la suppression ?');" href="?route=services_dsh&action=delete&id=<?= $srv['id'] ?>"><img class="effacer" src="assets/img/effacer.png" alt="Effacer la réalisation"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2><?= isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Modifier le service' : 'Ajouter un nouveau service' ?></h2>
    <form method="post" enctype="multipart/form-data">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" value="<?= isset($service['titre']) ? htmlspecialchars($service['titre']) : '' ?>" required><br><br>

        <label for="description">Description :</label><br>
        <textarea id="description" name="description" required><?= isset($service['description']) ? htmlspecialchars($service['description']) : '' ?></textarea><br><br>

        <label for="image">Image :</label><br>
        <input type="file" id="image" name="image" <?= isset($_GET['action']) && $_GET['action'] == 'edit' ? '' : 'required' ?>><br><br>

        <button type="submit" name="submit"><?= isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Modifier' : 'Ajouter' ?></button>
    </form>
    </main>
  
 <script src="assets/js/burger.js"></script>
</body>
</html>