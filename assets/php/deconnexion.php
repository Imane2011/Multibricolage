<?php
session_start(); // Démarre la session

// Vérifier si le bouton deconnexion est soumis
if(isset($_POST['submitDeconnexion'])){

    // Détruire la session
    session_destroy();

    // Rediriger l'utilisateur vers la page d'accueil
    header("Location: ../../index.php?route=connexion");
    exit(); 
}

?>