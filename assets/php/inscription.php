<?php
require("./db.php");

class Utilisateur {
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $adresse;
    private $codePostal;
    private $ville;
    private $pays;
    private $tel;

    public function __construct($nom, $prenom, $email, $password, $adresse, $codePostal, $ville, $pays, $tel) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->tel = $tel;
    }

    public function inscription($dbh) {
        // Vérifier si l'email existe déjà dans la BDD
        $req = $dbh->prepare("SELECT * FROM admins WHERE email = :email");
        $req->bindParam(':email', $this->email, PDO::PARAM_STR);

        if ($req->execute()) {
            $nb_resultat = $req->rowCount();

            if ($nb_resultat > 0) {
                echo "Email déjà utilisé !";
            } else {
                $sql = "INSERT INTO adresses (rue, code_postal, ville, pays)
                        VALUES (:rue, :cp, :ville, :pays)";
                $req = $dbh->prepare($sql);
                $req->bindParam(":rue", $this->adresse, PDO::PARAM_STR);
                $req->bindParam(":cp", $this->codePostal, PDO::PARAM_STR);
                $req->bindParam(":ville", $this->ville, PDO::PARAM_STR);
                $req->bindParam(":pays", $this->pays, PDO::PARAM_STR);

                if ($req->execute()) {
                    $id_adresse = $dbh->lastInsertId();

                    $sql = "INSERT INTO admins (nom, prenom, email, motDePasse, telephone, id_adresse_admin)
                            VALUES (:nom, :prenom, :email, :mdp, :tel, :adresse)";
                    $req = $dbh->prepare($sql);
                    $req->bindParam(":nom", $this->nom, PDO::PARAM_STR);
                    $req->bindParam(":prenom", $this->prenom, PDO::PARAM_STR);
                    $req->bindParam(":mdp", $this->password, PDO::PARAM_STR);
                    $req->bindParam(":email", $this->email, PDO::PARAM_STR);
                    $req->bindParam(":tel", $this->tel, PDO::PARAM_STR);
                    $req->bindParam(":adresse", $id_adresse, PDO::PARAM_INT);

                    if ($req->execute()) {
                        echo "Inscription réussie !";
                        header("location: ../../index.php?route=connexion");
                    } else {
                        echo "Erreur lors de l'insertion de l'administrateur.";
                    }
                } else {
                    echo "Erreur lors de l'inscription de l'adresse !";
                }
            }
        } else {
            echo "Erreur lors de la vérification de l'email.";
        }
    }
} 


if (isset($_POST["submitInscription"]) &&!empty($_POST["nom"]) &&!empty($_POST["prenom"]) &&!empty($_POST["email"]) &&!empty($_POST["mdp"]) &&!empty($_POST["mdp2"]) &&!empty($_POST['telephone']) && !empty($_POST["adresse"]) &&!empty($_POST["CP"]) &&!empty($_POST["ville"]) &&!empty($_POST["pays"])
) {if ($_POST["mdp"] !== $_POST["mdp2"]) {
        echo "Les mots de passe ne sont pas identiques.";
    } else {
        $utilisateur = new Utilisateur($_POST['nom'],$_POST["prenom"],$_POST["email"],$_POST["mdp"],$_POST["adresse"],$_POST['CP'],$_POST['ville'],$_POST["pays"],$_POST['telephone']
        );
        $utilisateur->inscription($dbh);
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
?>