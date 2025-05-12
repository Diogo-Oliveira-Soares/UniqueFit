<?php
// Inclure la connexion à la base de données
global $conn;
include '../Model/db_connector.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idproducts = $_POST['idproducts'];
    $name = $_POST['name'];
    $serial_number = 'SN0' . $_POST['serial_number'];  // Ajouter le préfixe SN0
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $image = null;

    // Gestion de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $upload_dir = __DIR__ . '/../CSS-Image/Image/';
        $image_path = $upload_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = 'CSS-Image/Image/' . $image_name;
        } else {
            echo "Erreur lors de l'upload de l'image.";
            exit;
        }
    }

    try {
        // Mettre à jour le produit
        $stmt = $conn->prepare("UPDATE products SET name = :name, serial_number = :serial_number, price = :price, description = :description, category = :category, image = :image WHERE idproducts = :idproducts");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':serial_number', $serial_number);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':idproducts', $idproducts);

        $stmt->execute();

        // Rediriger après la modification
        header('Location: ../View/admin_view.php');
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour du produit : " . $e->getMessage();
    }
}
?>
