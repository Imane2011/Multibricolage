<?php
ini_set('display_errors',true);
session_start();
require("./db.php");

class Utilisateur{
    private $email;
    private $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    public function connexion($dbh){
        $sql = "SELECT * FROM admins WHERE email = :email";
        $req = $dbh->prepare($sql);
        $req->bindParam(":email", $this->email, PDO::PARAM_STR);
        if($req->execute()){
            $nb_resultat = $req->rowCount();
            if($nb_resultat > 0){
                $resultat = $req->fetch(PDO::FETCH_ASSOC);
                if(password_verify($this->password, $resultat['motDePasse'])){
                    $token = $this->genererToken();
                    $_SESSION['id'] = $resultat['id'];
                    setcookie('token', $token, time() + 7200, "/");
                    header("Location: ../../index.php?route=admin");
                    exit();
                } else {
                   echo 'Mauvais mot de passe !';
                }
            } else {
                echo "Aucun email correspondant !";
            }
        } else {
            echo "Erreur lors de la requête !";
        }
    }

    // Fonction pour générer un token
    public function genererToken(){
        // Chaine de caractère pour le token
        $chaine = 'azertyuiopqsdfhjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789&é"(-è_çà)=';
        // Je transforme ma chaine en tableau
        $tableau = mb_str_split($chaine);
        // Je calcule la taille de la chaine de caractère avec count
        $longeur = count($tableau);
        // J'initialise une variable token vide
        $token = '';
        // On va générer une clé aléatoire avec une boucle for avec une longueur random entre 16 et 30
        for($i=0;$i<rand(16,30);$i++){
            // J'ajoute un caractère au token à chaque itération
            $token.= $tableau[rand(0,$longeur - 1)];
        }
        // Je hashe le token
        $token = md5(sha1($token));
        // J'enregistre mon token dans une session
        $_SESSION['token'] = $token;
        // Une fois mon token terminé je le retourne
        return $token;
    }
}

if(isset($_POST['submitConnexion']) && !empty($_POST['email']) && !empty($_POST['mdp'])){
    $user = new Utilisateur($_POST['email'], $_POST['mdp']);
    $user->connexion($dbh);
}





?>