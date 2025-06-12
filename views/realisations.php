
    <?php
// Connexion à la base
$dsn = "mysql:dbname=multi;host=localhost;port=3306";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

$sql = "SELECT * FROM realisations";
$req = $dbh->prepare($sql);
$req->execute();
$realisations = $req->fetchAll(PDO::FETCH_ASSOC);
?>
 <body>
     <main class="realisations">
      <h1 class="titreRealisations">Nos Réalisations</h1>
      <section class="carousel">
        <?php foreach ($realisations as $index => $realisation): ?>
        <div class="slide <?= $index === 0 ? 'active' : '' ?>">
          <img src="<?= htmlspecialchars($realisation['image']) ?>">
        </div>
        <?php endforeach; ?>
        <button class="btn" id="prev">&#10096</button>
        <button class="btn" id="next">&#10097</button>
      </section>
    </main>
 <script src="assets/js/realisations.js"></script>  
 </body>
 </html> 
