<?php
global $conn;
require_once __DIR__ . '/../Model/db_connector.php';

$category = isset($_GET['category']) ? $_GET['category'] : null;

try {
    // Si une catégorie est spécifiée, filtrer par catégorie et vérifier si le produit est actif
    if ($category) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE category = :category AND is_active = 1");
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        // Si aucune catégorie n'est spécifiée, récupérer tous les produits actifs
        $stmt = $conn->query("SELECT * FROM products WHERE is_active = 1");
    }

    // Récupérer les produits
    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $allProducts = [];
}
?>
