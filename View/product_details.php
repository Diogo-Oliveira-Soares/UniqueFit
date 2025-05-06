<?php
global $product, $couleurs, $tailles;
include __DIR__ . '/../Controller/get_product_details.php';

// Vérification de l'existence des données
if (!$product) {
    die("Le produit n'a pas été trouvé.");
}
if (!$couleurs) {
    $couleurs = [];
}
if (!$tailles) {
    $tailles = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($product['name']) ?> - Détail Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS-Image/CSS/product.css" />
</head>
<body>

<?php include __DIR__ . '../navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <!-- Image -->
        <div class="col-md-6 text-center">
            <img src="../CSS-Image/Image/<?= htmlspecialchars($product['image']) ?>"
                 class="img-fluid" style="max-height: 400px; object-fit: contain;"
                 alt="<?= htmlspecialchars($product['name']) ?>">
        </div>

        <!-- Infos produit -->
        <div class="col-md-6">
            <h3 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h3>
            <p class="h5"><?= htmlspecialchars($product['price']) ?> CHF</p>
            <p class="text-muted">N° de série : <?= htmlspecialchars($product['serial_number']) ?></p>

            <!-- Couleurs -->
            <div class="mb-3">
                <label class="form-label">Couleur :</label>
                <div class="btn-group" role="group">
                    <?php foreach ($couleurs as $color): ?>
                        <input type="radio" class="btn-check" name="couleur" id="couleur_<?= htmlspecialchars($color) ?>" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="couleur_<?= htmlspecialchars($color) ?>"><?= htmlspecialchars($color) ?></label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tailles -->
            <div class="mb-3">
                <label class="form-label">Taille :</label>
                <div class="btn-group" role="group">
                    <?php foreach ($tailles as $taille): ?>
                        <input type="radio" class="btn-check" name="taille" id="taille_<?= htmlspecialchars($taille) ?>" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="taille_<?= htmlspecialchars($taille) ?>"><?= htmlspecialchars($taille) ?></label>
                    <?php endforeach; ?>
                </div>
                <div class="mt-1"><a href="#" class="text-decoration-underline">Guide des tailles</a></div>
            </div>

            <!-- Actions -->
            <div class="mb-3">
                <button class="btn btn-primary me-2">Personnaliser</button>
                <button class="btn btn-danger">Ajouter au panier</button>
            </div>

            <p class="description"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
        </div>
    </div>
</div>

<?php include __DIR__ . "../footer.html"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
