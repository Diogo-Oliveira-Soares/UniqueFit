<?php
include __DIR__ . '/../Controller/cart_controller.php';
$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/cart.css">
</head>
<body>

<?php include __DIR__ . "/navbar.php"; ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Mon Panier</h2>

    <?php if (empty($cart)): ?>
        <div class="card p-5 shadow-sm text-center empty-cart">
            <i class="fas fa-shopping-cart fa-4x text-secondary mb-3"></i>
            <h4 class="mb-3">Votre panier est vide</h4>
            <p class="text-muted mb-4">Ajoutez des articles pour commencer votre shopping !</p>
            <a href="product.php" class="btn btn-outline-primary">Voir les produits</a>
        </div>
    <?php else: ?>
        <div id="cart-content" class="card p-4 shadow-sm mt-4">
            <div id="cart-items">
                <?php foreach ($cart as $item):
                    // Calculer le total pour cet article
                    $itemTotal = isset($item['price']) ? $item['price'] * $item['quantity'] : 0;
                    $total += $itemTotal;

                    // Vérification et gestion des valeurs nulles ou manquantes
                    $imagePath = isset($item['image']) ? "../CSS-Image/Image/" . htmlspecialchars($item['image']) : "../CSS-Image/Image/default-image.jpg";
                    $imageAlt = isset($item['name']) ? htmlspecialchars($item['name']) : "Produit sans nom";
                    $itemName = isset($item['name']) ? htmlspecialchars($item['name']) : "Nom non défini";
                    $itemColor = isset($item['couleur']) ? htmlspecialchars($item['couleur']) : "Couleur non spécifiée";
                    $itemSize = isset($item['taille']) ? htmlspecialchars($item['taille']) : "Taille non spécifiée";
                    $itemText = isset($item['personnalisation']) ? nl2br(htmlspecialchars($item['personnalisation'])) : "Aucune personnalisation";
                    $textColor = isset($item['textColor']) ? htmlspecialchars($item['textColor']) : "#000000"; // couleur par défaut
                    $textSize = isset($item['textSize']) ? $item['textSize'] : 16; // taille par défaut
                    $imageShape = isset($item['imageShape']) ? $item['imageShape'] : "100%"; // forme par défaut
                    $imageSize = isset($item['imageSize']) ? $item['imageSize'] : 50; // taille par défaut
                    ?>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center border-bottom py-3 gap-3">
                        <div class="d-flex gap-3 align-items-start">
                            <img src="<?= $imagePath ?>" alt="<?= $imageAlt ?>" style="height: 60px; width: 60px; object-fit: contain;">
                            <div>
                                <div class="fw-bold"><?= $itemName ?></div>
                                <div class="text-muted small">
                                    <!-- Affichage des informations de personnalisation -->
                                    <?php if (!empty($itemText)): ?>
                                        <div class="fst-italic">Personnalisation : <?= $itemText ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($itemColor)): ?>
                                        <div>Couleur : <?= $itemColor ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($itemSize)): ?>
                                        <div>Taille : <?= $itemSize ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($textSize)): ?>
                                        <div>Taille du texte : <?= $textSize ?>px</div>
                                    <?php endif; ?>
                                    <?php if (!empty($textColor)): ?>
                                        <div>Couleur du texte : <span style="color: <?= $textColor ?>"><?= $textColor ?></span></div>
                                    <?php endif; ?>
                                    <?php if (!empty($imageShape)): ?>
                                        <div>Forme de l'image : <?= $imageShape ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($imageSize)): ?>
                                        <div>Taille de l'image : <?= $imageSize ?>px</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row gap-2 align-items-md-center mt-3 mt-md-0 w-100 justify-content-md-end">
                            <form method="POST" class="d-flex align-items-center">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                                <input type="number" name="quantity" value="<?= isset($item['quantity']) ? htmlspecialchars($item['quantity']) : 1 ?>" min="1"
                                       class="form-control form-control-sm me-2 text-center" style="width: 70px;">
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Mettre à jour</button>
                            </form>

                            <div class="fw-bold"><?= number_format($itemTotal, 2) ?> CHF</div>

                            <form method="POST">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div id="cart-total" class="text-end fw-bold fs-5 my-3">Total : <?= number_format($total, 2) ?> CHF</div>

            <div class="text-center">
                <button id="pay-btn" class="btn btn-primary px-4" onclick="window.location.href='checkout.php';">Payer</button>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . "/footer.html"; ?>

</body>
</html>
