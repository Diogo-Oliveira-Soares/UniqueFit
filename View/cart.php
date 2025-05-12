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

<?php include __DIR__ . "../navbar.php"; ?>

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
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
                    $imagePath = "../CSS-Image/Image/" . htmlspecialchars($item['image']);
                    $imageAlt = htmlspecialchars($item['name']);
                    $defaultImage = "../CSS-Image/Image/default-image.jpg";
                    ?>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center border-bottom py-3 gap-3">
                        <div class="d-flex gap-3 align-items-start">
                            <img src="<?= file_exists($imagePath) ? $imagePath : $defaultImage ?>"
                                 alt="<?= $imageAlt ?>" style="height: 60px; width: 60px; object-fit: contain;">
                            <div>
                                <div class="fw-bold"><?= htmlspecialchars($item['name']) ?></div>
                                <div class="text-muted small">Couleur : <?= htmlspecialchars($item['couleur']) ?> | Taille : <?= htmlspecialchars($item['taille']) ?></div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row gap-2 align-items-md-center mt-3 mt-md-0 w-100 justify-content-md-end">
                            <form method="POST" class="d-flex align-items-center">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                                <input type="number" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" min="1"
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

<?php include __DIR__ . "../footer.html"; ?>

</body>
</html>
