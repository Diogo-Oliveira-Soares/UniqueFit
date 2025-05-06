<?php
global $conn;
require_once __DIR__ . '/../Model/db_connector.php';

$category = isset($_GET['category']) ? $_GET['category'] : null;

try {
    if ($category) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE category = :category");
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        $stmt = $conn->query("SELECT * FROM products");
    }

    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $allProducts = [];
}
?>
