<?php

// Connection à la BDD
require("./db.php");

require ('../../vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Devis{
    private $nom;
    private $prenom;
    private $email;
    private $tel;
    private $adresse;
    private $codePostal;
    private $ville;
    private $pays;
    private $services;
    private $informations;

    public function __construct($nom, $prenom, $email, $tel, $adresse, $codePostal, $ville, $pays, $services, $informations){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->tel = $tel;
         $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->services = $services;
        $this->informations = $informations;
    }

    public function envoyerDevis($dbh){
        $sql= "INSERT INTO adresses (rue, code_postal, ville, pays)
                VALUE (:rue, :cp, :ville, :pays)";
                $req = $dbh->prepare($sql);
                $req->bindParam(":rue", $this->adresse, PDO::PARAM_STR);
                $req->bindParam(":cp", $this->codePostal, PDO::PARAM_STR);
                $req->bindParam(":ville", $this->ville, PDO::PARAM_STR);
                $req->bindParam(":pays", $this->pays, PDO::PARAM_STR);
                 if($req->execute()){
         // Récupérer le dernier id_adresse inséré
        $id_adresse = $dbh->lastInsertId();
                $sql = "INSERT INTO clients (nom, prenom, email, telephone, id_adresse_client)
                        VALUE (:nom, :prenom, :email, :tel, :id_adresse)";
                $req = $dbh->prepare($sql);
                $req->bindParam(":nom", $this->nom, PDO::PARAM_STR);
                $req->bindParam(":prenom", $this->prenom, PDO::PARAM_STR);
                $req->bindParam(":email", $this->email, PDO::PARAM_STR);
                $req->bindParam(":tel", $this->tel, PDO::PARAM_STR);
                $req->bindParam(":id_adresse", $id_adresse, PDO::PARAM_INT);
                }
            if($req->execute()){
         // Récupérer le dernier id_adresse inséré
            $id_client = $dbh->lastInsertId();
                $sql = "INSERT INTO devis (services, info_complementaire, client_id) VALUES (:service, :info, :client_id)";
                $req = $dbh->prepare($sql);
                $req->bindValue(':service',$this->services,PDO::PARAM_STR);
                $req->bindValue(':info',$this->informations,PDO::PARAM_STR);
                $req->bindParam(":client_id", $id_client, PDO::PARAM_INT);

       
            if($req->execute()){
            $this->envoyerMail();
           echo "Message bien envoyé !";
        } else {
            echo "Erreur lors de l'envois du message !";
        }
      }
    }
   

    public function envoyerMail(){
        $mail = new PHPMailer(true);
        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Pour débugguer              
            $mail->isSMTP();                                            
            $mail->Host       = 'dwwm2425.fr';      //Nom de domaine    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'contact@dwwm2425.fr'; //User name      
            $mail->Password   = '!cci18000Bourges!';  //Mot de passe    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                    

            //Recipients
            $mail->setFrom('no-reply@dww2425.fr', 'Formulaire contact from - monSite'); // Email d'envoi
            $mail->addAddress("amri.imane018@gmail.com"); //Email pour recevoir les mails (nom optionel)

            //Content
            $fichier = file_get_contents('../../views/messageDevis.html');
            $fichier = str_replace('[PRENOM]',$this->prenom,$fichier);
            $fichier = str_replace('[NOM]',$this->nom,$fichier);
            $fichier = str_replace('[MAIL]',$this->email,$fichier);
            $fichier = str_replace('[TEL]',$this->tel,$fichier);
            $fichier = str_replace('[SERVICE]',$this->services,$fichier);
            $fichier = str_replace('[INFO]',$this->informations,$fichier);
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = "Demande de devis pour" . $this->services; // Objet du message
            $mail->Body    = $fichier; // Contenu du message
            $mail->AltBody = $fichier; // Contenu alternatif du message

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

    if(isset($_POST["submitDevis"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["telephone"]) && !empty($_POST["services"]) && !empty($_POST["info"])){
    // var_dump($_POST);
    $contact = new Devis($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['adresse'], $_POST["CP"], $_POST["ville"], $_POST["pays"], $_POST['services'], $_POST["info"]);
    $contact->envoyerDevis($dbh);
}

?>