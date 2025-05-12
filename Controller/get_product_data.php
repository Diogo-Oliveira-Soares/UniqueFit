<?php
// Inclure la connexion à la base de données
global $conn;
include '../Model/db_connector.php';

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Récupérer les données du produit
    $stmt = $conn->prepare("SELECT * FROM products WHERE idproducts = :idproducts");
    $stmt->bindParam(':idproducts', $product_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si le produit n'existe pas
    if (!$product) {
        echo "Produit non trouvé.";
        exit;
    }
} else {
    echo "Aucun ID de produit fourni.";
    exit;
}
?>
