<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/product.css">
</head>
<body>

<?php include __DIR__ . "../navbar.html"; ?>

<div class="container my-5">
    <!-- Bouton filtre en haut à gauche -->
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-outline-primary d-flex align-items-center gap-2">
            <i class="bi bi-funnel-fill"></i> Filtrer
        </button>
    </div>

    <!-- Grille centrée de produits -->
    <div class="d-flex justify-content-center">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <div class="col">
                    <div class="card produit-card h-100 text-center">
                        <div class="card-img-top bg-light d-flex justify-content-center align-items-center p-3" style="height: 180px;">
                            <a href="#"><img src="../CSS-Image/Image/no-image.png" class="img-fluid image-produit" alt="Produit <?= $i ?>"></a>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold">Produit <?= $i ?></h6>
                            <p class="text-muted mb-0">Prix</p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . "../footer.html"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
