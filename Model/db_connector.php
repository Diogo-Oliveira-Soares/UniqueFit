<?php
$servername = "localhost";
$username = "AdminUF";    // Nom d'utilisateur pour gérer la DB
$password = 'Pa$$w0rd'; // Mot de passe pour AdminUF avec '' pour que le "$$" ne crée pas de soucis dans le code
$dbname = "UniqueFit";

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    // En cas d'erreur
    echo "Erreur de connexion: " . $e->getMessage();
}
?>
