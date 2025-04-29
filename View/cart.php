<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/cart.css">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Mon Panier</h2>

    <div class="card p-5 shadow-sm text-center empty-cart">
        <i class="fas fa-shopping-cart fa-4x text-secondary mb-3"></i>
        <h4 class="mb-3">Votre panier est vide</h4>
        <p class="text-muted mb-4">Ajoutez des articles pour commencer votre shopping !</p>
        <a href="product.php" class="btn btn-outline-primary">Voir les produits</a>
    </div>

    <!-- Zone masquée qui s'affichera quand des articles seront ajoutés -->
    <div id="cart-content" class="card p-4 shadow-sm d-none mt-4">
        <div id="cart-items"></div>
        <div id="cart-total" class="text-end fw-bold fs-5 my-3">Total : 0.-</div>
        <div class="text-center">
            <button id="pay-btn" class="btn btn-primary px-4">Payer</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
