<?php
$dsn = "mysql:dbname=multi;host=localhost;port=3306";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

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

    public function __construct($nom, $prenom, $email, $password, $adresse, $codePostal, $ville, $pays, $tel){
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

    public function inscription($dbh){
        // Vérifier si l'email existe déjà dans la BDD
        $req = $dbh->prepare("SELECT * FROM administrateurs WHERE email = :email");
        $req->bindParam(':email', $this->email, PDO::PARAM_STR);
        if($req->execute()){
            $nb_resultat = $req->rowCount();
            if($nb_resultat > 0) {
                echo "Email déja utilisé !";
            } else {
                $sql = "INSERT INTO adresse (rue, code_postal, ville, pays)
                VALUE (:rue, :cp, :ville, :pays)";
                $req = $dbh->prepare($sql);
                $req->bindParam(":rue", $this->adresse, PDO::PARAM_STR);
                $req->bindParam(":cp", $this->codePostal, PDO::PARAM_STR);
                $req->bindParam(":ville", $this->ville, PDO::PARAM_STR);
                $req->bindParam(":pays", $this->pays, PDO::PARAM_STR);
                if($req->execute()){
                    $sql = "SELECT id_adresse FROM adresse ORDER BY id_adresse DESC LIMIT 1";
                    $req = $dbh->prepare($sql);
                    if($req->execute()){
                        $nb_resultat = $req->rowCount();
                        if($nb_resultat > 0){
                            $idAdresse = $req->fetch(PDO::FETCH_ASSOC);
                            $sql = "INSERT INTO administrateurs (nom, prenom, email, motDePasse, telephone, id_adresse_admin, date_creation)
                            VALUE (:nom, :prenom, :email, :mdp, :tel, :adresse, now())";
                            $req = $dbh->prepare($sql);
                            $req->bindParam(":nom", $this->nom, PDO::PARAM_STR);
                            $req->bindParam(":prenom", $this->prenom, PDO::PARAM_STR);
                            $req->bindParam(":mdp", $this->password, PDO::PARAM_STR);
                            $req->bindParam(":email", $this->email, PDO::PARAM_STR);
                            $req->bindParam(":tel", $this->tel, PDO::PARAM_STR);
                            $req->bindParam(":adresse", $idAdresse['id_adresse'], PDO::PARAM_INT);
                            if($req->execute()){
                                echo "Inscription réussie !";
                                // header("location: ../../index.php?route=registre");
                            }
                        } else {
                            echo "Aucun résultat !";
                        }
                    } else {
                        echo "Erreur !";
                    }
                } else {
                    echo "Erreur lors de l'inscription de l'adresse !";
                }
            }
        } else {
            echo "Erreur de la requête !";
        }
    }
}

if(isset($_POST["submitInscription"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["mdp2"]) && !empty($_POST['telephone']) && !empty($_POST["adresse"]) && !empty($_POST["CP"]) && !empty($_POST["ville"]) && !empty($_POST["pays"]))
{
    // Vérifier si les mots de passe sont identiques
    if ($_POST["mdp"] !== $_POST["mdp2"]) {
        echo("les mots de passes ne sont pas identiques");
    } else {
        $utilisateur = new Utilisateur($_POST['nom'], $_POST["prenom"], $_POST["email"], $_POST["mdp"], $_POST["adresse"], $_POST['CP'], $_POST['ville'], $_POST["pays"], $_POST['telephone']);
        $utilisateur->inscription($dbh);
    }
} else {
    echo "Veuillez remplir tous les champs";
}
?>