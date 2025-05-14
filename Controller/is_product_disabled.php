<?php
global $conn;
include '../Model/db_connector.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE idproducts = :id");
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Redirection si produit introuvable ou désactivé
    if (!$product || $product['is_active'] == 0) {
        header('Location: ../View/home.php');
        exit;
    }

    // Le produit est actif, on peut l'afficher
    // (Ton code HTML d'affichage du produit ici)

} else {
    echo "Aucun ID de produit fourni.";
    exit;
}
?>
