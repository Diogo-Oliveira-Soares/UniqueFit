<?php
// Inclure la connexion à la base de données
global $conn;
include '../Model/db_connector.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $serial_number = 'SN0' . $_POST['serial_number'];  // Ajouter le préfixe "SN0"
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Gestion de l'image
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $upload_dir = __DIR__ . '/../CSS-Image/Image/';
        $image_path = $upload_dir . $image_name;

        // Créer le dossier s'il n'existe pas
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = 'CSS-Image/Image/' . $image_name; // Chemin relatif à stocker
        } else {
            echo "Erreur lors de l'upload de l'image.";
            exit;
        }
    }

    try {
        // Vérification d'unicité du numéro de série
        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE serial_number = :serial_number");
        $check_stmt->bindParam(':serial_number', $serial_number);
        $check_stmt->execute();
        $exists = $check_stmt->fetchColumn();

        if ($exists > 0) {
            echo "Erreur : Ce numéro de série existe déjà.";
            exit;
        }

        // Insérer le produit principal
        $stmt = $conn->prepare("INSERT INTO products (name, serial_number, price, description, category, image) 
                                VALUES (:name, :serial_number, :price, :description, :category, :image)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':serial_number', $serial_number);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);
        $stmt->execute();

        // Obtenir l'ID du nouveau produit
        $product_id = $conn->lastInsertId();

        // Insérer les variantes si présentes
        if (!empty($_POST['color']) && !empty($_POST['size']) && !empty($_POST['stock'])) {
            $colors = $_POST['color'];
            $sizes = $_POST['size'];
            $stocks = $_POST['stock'];

            $stmt_variant = $conn->prepare("INSERT INTO product_variants (idproducts, color, size, stock) 
                                            VALUES (:idproducts, :color, :size, :stock)");

            for ($i = 0; $i < count($colors); $i++) {
                if (!empty($colors[$i]) && !empty($sizes[$i]) && isset($stocks[$i])) {
                    $stmt_variant->execute([
                        ':idproducts' => $product_id,
                        ':color' => $colors[$i],
                        ':size' => $sizes[$i],
                        ':stock' => $stocks[$i]
                    ]);
                }
            }
        }

        // Redirection
        header('Location: ../View/admin_view.php');
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du produit : " . $e->getMessage();
    }
}
