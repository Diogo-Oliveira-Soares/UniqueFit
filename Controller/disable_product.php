<?php
// Inclure la connexion à la base de données
global $conn;
include '../Model/db_connector.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Désactiver le produit
    $stmt = $conn->prepare("UPDATE products SET is_active = 0 WHERE idproducts = :idproducts");
    $stmt->bindParam(':idproducts', $product_id);
    $stmt->execute();

    // Redirection après la mise à jour
    header('Location: ../View/admin_view.php');
    exit;
} else {
    echo "Aucun ID de produit fourni.";
    exit;
}
?>
