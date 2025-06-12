<?php
// Connexion à la base de données
$dsn = "mysql:dbname=multi;host=localhost;port=3306";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));

?>