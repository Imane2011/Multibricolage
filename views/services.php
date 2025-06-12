
<?php
// Connexion à la base
$dsn = "mysql:dbname=multi;host=localhost;port=3306";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

$sql = "SELECT * FROM services";
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