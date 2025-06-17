<?php
require("assets/php/check_connexion.php");

?>

    <main>
        <section classe="titre">
            <h1>Bienvenue dans l'Interface Admin</h1>
        </section>
        
        <section class="dashboard">
            <div class="card">
                <h2> Services</h2>
                <a href="?route=services_dsh" class="btn_accueil">Gérer les Services</a>
            </div>
            <div class="card">
                <h2>Réalisations</h2>
                <a href="?route=realisations_dsh" class="btn_accueil">Gérer les Réalisations</a>
            </div>
            
        </section>
    </main>
    <script src="assets/js/burger.js"></script>
</body>
</html>