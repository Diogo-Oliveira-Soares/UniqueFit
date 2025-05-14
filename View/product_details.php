<?php
global $product, $couleurs, $tailles;
include '../Controller/is_product_disabled.php';

// Vérifiez que l'ID du produit est passé dans l'URL
$productId = $_GET['id'] ?? null;

if (!$productId) {
    die("ID de produit manquant.");
}

// Assurez-vous d'utiliser votre fonction pour récupérer les détails du produit en fonction de l'ID
include __DIR__ . '/../Controller/get_product_details.php'; // Cette fonction doit définir $product, $couleurs, $tailles

// Si le produit n'a pas été trouvé
if (!$product) {
    die("Le produit n'a pas été trouvé.");
}

// Initialisez les couleurs et tailles par défaut si non définis
$couleurs = $couleurs ?? [];
$tailles = $tailles ?? [];
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($product['name'] ?? '') ?> - Détail Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS-Image/CSS/product.css" />
</head>

<body>

<?php include __DIR__ . '../navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <!-- Image du produit -->
        <div class="col-md-6 text-center">
            <img src="../CSS-Image/Image/<?= htmlspecialchars($product['image'] ?? '') ?>"
                 class="img-fluid" style="max-height: 400px; object-fit: contain;"
                 alt="<?= htmlspecialchars($product['name'] ?? '') ?>">
        </div>

        <!-- Informations du produit -->
        <div class="col-md-6">
            <h3 class="fw-bold"><?= htmlspecialchars($product['name'] ?? '') ?></h3>
            <p class="h5"><?= htmlspecialchars($product['price'] ?? '') ?> CHF</p>
            <p class="text-muted">N° de série : <?= htmlspecialchars($product['serial_number'] ?? '') ?></p>

            <!-- Formulaire d'ajout au panier -->
            <form method="POST" action="../Controller/add_to_cart.php" onsubmit="return validateForm();">
                <input type="hidden" name="id" value="<?= htmlspecialchars($product['idproducts'] ?? '') ?>"> <!-- Modification ici -->
                <input type="hidden" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($product['price'] ?? '') ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($product['image'] ?? '') ?>">

                <!-- Quantité -->
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité :</label>
                    <input type="number" id="quantite" name="quantity" class="form-control w-25 mb-3" value="1" min="1" required>
                </div>

                <!-- Couleur -->
                <input type="hidden" id="couleur_hidden" name="couleur" value="">
                <div class="mb-3">
                    <label class="form-label" for="couleur_radio">Couleur :</label>
                    <div class="btn-group" role="group">
                        <?php foreach ($couleurs as $color): ?>
                            <input type="radio" class="btn-check" name="couleur_radio" id="couleur_<?= htmlspecialchars($color) ?>" value="<?= htmlspecialchars($color) ?>" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="couleur_<?= htmlspecialchars($color) ?>"><?= htmlspecialchars($color) ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Taille -->
                <input type="hidden" id="taille_hidden" name="taille" value="">
                <div class="mb-3">
                    <label class="form-label" for="taille_radio">Taille :</label>
                    <div class="btn-group" role="group">
                        <?php foreach ($tailles as $taille): ?>
                            <input type="radio" class="btn-check" name="taille_radio" id="taille_<?= htmlspecialchars($taille) ?>" value="<?= htmlspecialchars($taille) ?>" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="taille_<?= htmlspecialchars($taille) ?>"><?= htmlspecialchars($taille) ?></label>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-1"><a href="#" class="text-decoration-underline">Guide des tailles</a></div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button type="submit" class="btn btn-danger">Ajouter au panier</button>
                    <a href="personalise_product.php?id=<?= htmlspecialchars($product['idproducts'] ?? '') ?>" class="btn btn-primary">Personnaliser</a>
                </div>
            </form>

            <script>
                // Mise à jour des valeurs cachées pour couleur et taille
                document.querySelectorAll('input[name="couleur_radio"]').forEach(radio => {
                    radio.addEventListener('change', () => {
                        document.getElementById('couleur_hidden').value = radio.value;
                    });
                });
                document.querySelectorAll('input[name="taille_radio"]').forEach(radio => {
                    radio.addEventListener('change', () => {
                        document.getElementById('taille_hidden').value = radio.value;
                    });
                });

                // Validation JavaScript pour empêcher l'envoi sans sélection
                function validateForm() {
                    const couleur = document.getElementById('couleur_hidden').value;
                    const taille = document.getElementById('taille_hidden').value;

                    if (!couleur || !taille) {
                        alert("Veuillez sélectionner une couleur et une taille.");
                        return false;
                    }
                    return true;
                }
            </script>

            <p class="description"><?= nl2br(htmlspecialchars($product['description'] ?? '')) ?></p>
        </div>
    </div>

</div>

<?php include __DIR__ . '../footer.html'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
