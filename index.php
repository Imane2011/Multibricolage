<?php
session_start();

// Les routes vont êtres gérer avec un switch
if(!empty($_GET['route'])){
    // Si route n'est pas vide je l'enregistre dans la variable route
    $route = $_GET['route'];
} else {
    // Sinon la variable route est null
    $route = null;
}

switch($route){
 // Vue services
    case 'entreprise':
    $titrePage = 'entrprise';
    include('./views/header.php');
    require("views/index.html");
    include('./views/footer.php');
    break;
}
   

switch($route){
    // Vue services
    case 'services':
        $titrePage = 'services';
        include('./views/header.php');
        require("views/services.php");
        include('./views/footer.php');
    break;

    // Vue réalisations
    case 'realisations':
        $titrePage = 'realisations';
        include('./views/header.php');
        require("views/realisations.php");
        include('./views/footer.php');
    break;

    // Vue contact
    case 'contact':
        $titrePage = 'contact';
        include('./views/header.php');
        require("views/contact.html");
        include('./views/footer.php');
    break;

    // Vue devis
    case 'devis':
        $titrePage = 'devis';
        include('./views/header.php');
        require("views/devis.html");
        include('./views/footer.php');
    break;

    // Vue devis
    case 'mentionsLegales':
        $titrePage = 'mentionsLegales';
        include('./views/header.php');
        require("views/mentionsLegales.html");
        include('./views/footer.php');
    break;

    // Vue inscription admin
    case 'inscription':
        $titrePage = 'inscription';
        include('./views/header.php');
        require("views/inscription.html");
        include('./views/footer.php');
    break;

    // Vue connexion admin
    case 'connexion':
        $titrePage = 'connexion';
        include('./views/header.php');
        require("./views/connexion.html");
        include('./views/footer.php');
    break;

     // Vue admin
    case 'admin':
        $titrePage = 'admin';
        include('./views/header_dsh.php');
        require("./views/admin.php");
        include('./views/footer_dsh.php');
    break;

    case 'services_dsh':
        $titrePage = 'services_dsh';
        include('./views/header_dsh.php');
        require("./views/services_dashboard.php");
        include('./views/footer_dsh.php');
    break;

     case 'realisations_dsh':
        $titrePage = 'realisations_dsh';
        include('./views/header_dsh.php');
        require("./views/realisations_dashboard.php");
        include('./views/footer_dsh.php');
    break;



    // Vue par défaut (accueil)
    default:
        $titrePage = 'Accueil';
        $template = file_get_contents('./views/index.html');
        
        
    break;
}

if (isset($template)){
    include('./views/header.php');
   
    echo $template;
    include('./views/footer.php');
    //  include('./views/header_dsh.php');
    // include('./views/footer_dsh.php');
}
?>