<?php
global $conn;
require_once __DIR__ . '/../Model/db_connector.php';

try {
    $stmt = $conn->query("SELECT * FROM products");
    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $allProducts = [];
}
?>
