<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vue Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/admin_view.css"">
</head>
<body>

<?php include __DIR__ . "../navbar.php"; ?>

<!-- Admin View -->
<main class="container my-5">
    <div class="admin-box p-4 border rounded">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">vue administrateur</h4>
            <button class="btn btn-primary">nouveau</button>
        </div>

        <!-- Product List -->
        <div class="product-item d-flex justify-content-between align-items-center border p-2 mb-3">
            <span>produit 1</span>
            <div>
                <button class="btn btn-secondary btn-sm me-2">modifier</button>
                <button class="btn btn-danger btn-sm">x</button>
            </div>
        </div>

        <div class="product-item d-flex justify-content-between align-items-center border p-2 mb-3">
            <span>produit 2</span>
            <div>
                <button class="btn btn-secondary btn-sm me-2">modifier</button>
                <button class="btn btn-danger btn-sm">x</button>
            </div>
        </div>

        <div class="product-item d-flex justify-content-between align-items-center border p-2 mb-3">
            <span>produit 3</span>
            <div>
                <button class="btn btn-secondary btn-sm me-2">modifier</button>
                <button class="btn btn-danger btn-sm">x</button>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . "../footer.html"; ?>

</body>
</html>
