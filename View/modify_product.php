<?php
global $product;
include '../Controller/get_product_data.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include __DIR__ . "../navbar.php"; ?>

<!-- Formulaire de modification -->
<main class="container my-5">
    <div class="admin-box p-4 border rounded">
        <h4>Modifier un Produit</h4>
        <form method="POST" action="../Controller/modify_product_handler.php" enctype="multipart/form-data">
            <input type="hidden" name="idproducts" value="<?php echo $product['idproducts']; ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="serial_number" class="form-label">Numéro de série</label>
                <input type="number" class="form-control" id="serial_number" name="serial_number" value="<?php echo substr($product['serial_number'], 3); ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($product['description']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="../<?php echo $product['image']; ?>" alt="Image actuelle" class="mt-2" style="max-width: 150px;">
            </div>

            <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
        </form>
    </div>
</main>

<?php include __DIR__ . "../footer.html"; ?>

</body>
</html>
