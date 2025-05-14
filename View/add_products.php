<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/admin_view.css">
</head>
<script>
    function addVariant() {
        const container = document.getElementById('variants-container');
        const variant = document.createElement('div');
        variant.className = 'variant row mb-2';
        variant.innerHTML = `
        <div class="col">
            <input type="text" name="color[]" class="form-control" placeholder="Couleur">
        </div>
        <div class="col">
            <input type="text" name="size[]" class="form-control" placeholder="Taille">
        </div>
        <div class="col">
            <input type="number" name="stock[]" class="form-control" placeholder="Quantité">
        </div>
    `;
        container.appendChild(variant);
    }
</script>

<body>

<?php include __DIR__ . "/navbar.php"; ?>

<!-- Formulaire d'ajout de produit -->
<main class="container my-5">
    <div class="admin-box p-4 border rounded">
        <h4>Ajouter un Nouveau Produit</h4>
        <form method="POST" action="../Controller/add_product_handler.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="serial_number" class="form-label">Numéro de série</label>
                <input type="number" class="form-control" id="serial_number" name="serial_number" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <!-- Variantes -->
            <h5 class="mt-4">Variantes du produit</h5>
            <div id="variants-container">
                <div class="variant row mb-2">
                    <div class="col">
                        <input type="text" name="color[]" class="form-control" placeholder="Couleur">
                    </div>
                    <div class="col">
                        <input type="text" name="size[]" class="form-control" placeholder="Taille">
                    </div>
                    <div class="col">
                        <input type="number" name="stock[]" class="form-control" placeholder="Quantité">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addVariant()">Ajouter une variante</button>

            <button type="submit" class="btn btn-primary">Ajouter Produit</button>
        </form>

    </div>
</main>

<?php include __DIR__ . "/footer.html"; ?>

</body>
</html>
