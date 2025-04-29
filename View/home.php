<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/home.css">
</head>

<body>

<?php include __DIR__ . "../navbar.html"; ?>

<section class="container my-5">
    <h4 class="mb-4">Quelques Suggestions :</h4>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        <div class="col">
            <div class="card produit text-center">
                <img src="../CSS-Image/Image/no-image.png" class="card-img-top" alt="Produit 1">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Produit 1</h5>
                    <p class="card-text">Prix</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card produit text-center">
                <img src="../CSS-Image/Image/no-image.png" class="card-img-top" alt="Produit 2">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Produit 2</h5>
                    <p class="card-text">Prix</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card produit text-center">
                <img src="../CSS-Image/Image/no-image.png" class="card-img-top" alt="Produit 3">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Produit 3</h5>
                    <p class="card-text">Prix</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card produit text-center">
                <img src="../CSS-Image/Image/no-image.png" class="card-img-top" alt="Produit 4">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Produit 4</h5>
                    <p class="card-text">Prix</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . "../footer.html"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>