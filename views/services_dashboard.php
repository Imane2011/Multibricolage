
<?php

require("assets/php/insert_services");

?>
   <main>
         <section classe="titreServices">
        <h1>Gestion des services</h1>
    </section>
    

    <table class="tableService">
        <thead class="theadService">
            <tr class="trService">
                <th class="thService">Titre</th>
                <th class="thService">Description</th>
                <th class="thService">Image</th>
                <th class="thService">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $srv): ?>
                <tr>
                    <td class="tdService"><?= htmlspecialchars($srv['titre']) ?></td>
                    <td class="tdService"><?= htmlspecialchars($srv['description']) ?></td>
                    <td class="tdService"><img src="<?= htmlspecialchars($srv['image']) ?>" alt="<?= htmlspecialchars($srv['titre']) ?>"></td>
                    <td>
                        <a class="btn" href="?route=services_dsh&action=edit&id=<?= $srv['id_service'] ?>"><img class="modifier" src="assets/img/modifier.png" alt="Modifier le service"></a>
                        <a class="btn" onclick="return confirm('Confirmer la suppression ?');" href="?route=services_dsh&action=delete&id=<?= $srv['id_service'] ?>"><img class="effacer" src="assets/img/effacer.png" alt="Effacer la réalisation"></a>
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