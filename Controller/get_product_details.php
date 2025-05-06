<?php
global $conn;
include __DIR__ . '/../Model/db_connector.php';

if (!isset($_GET['id'])) {
    die("Aucun identifiant de produit fourni.");
}

$id = $_GET['id'];

// Récupérer le produit
$stmt = $conn->prepare("SELECT * FROM products WHERE idproducts = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Produit introuvable.");
}

// Récupérer les variantes
$variantStmt = $conn->prepare("SELECT DISTINCT size, color FROM product_variants WHERE idproducts = :id");
$variantStmt->execute(['id' => $id]);
$variants = $variantStmt->fetchAll(PDO::FETCH_ASSOC);

// Extraire tailles et couleurs uniques
$tailles = array_unique(array_column($variants, 'size'));
$couleurs = array_unique(array_column($variants, 'color'));
?>
