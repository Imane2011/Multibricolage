
<?php

require("assets/php/insert_realisations");

?>

<main>
    <section classe="titre">
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
</main>

<script src="assets/js/burger.js"></script>
</body>
</html>