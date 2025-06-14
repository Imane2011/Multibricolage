
<?php
// Connexion à la base
require("assets/php/db.php");

$sql = "SELECT * FROM page_services";
$req = $dbh->prepare($sql);
$req->execute();
$services = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<body> 
<main class="services">
    <h1 class="titreServices">Nos Services</h1>
    <section class="containerServices">
        <?php foreach ($services as $service): ?>
                <div class="service-item">
                    <img class="imgService" src="<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['titre']) ?>">
                    <h2><?= htmlspecialchars($service['titre']) ?></h2>
                    <p class="paragService"><?= htmlspecialchars($service['description']) ?></p>
                </div>
        <?php endforeach; ?>
    </section>
</main>
 <script src="assets/js/burger.js"></script>
</body>
</html>