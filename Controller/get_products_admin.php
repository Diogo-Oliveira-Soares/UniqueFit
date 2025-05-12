<?php
// Inclure la connexion à la base de données
global $conn;
include '../Model/db_connector.php';

// Requête pour récupérer les produits
try {
    // Remplacez 'idproducts' et 'name' par les noms de colonnes corrects
    $stmt = $conn->prepare("SELECT idproducts, name, serial_number, price, description, category, image, is_active FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erreur lors de la récupération des produits: " . $e->getMessage();
}
?>
