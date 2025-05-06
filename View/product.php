<?php
global $allProducts, $conn;
include __DIR__ . '/../Model/db_connector.php';

// Récupération des catégories depuis la table products
$stmtCat = $conn->prepare("SELECT DISTINCT category FROM products ORDER BY category ASC");
$stmtCat->execute();
$categories = $stmtCat->fetchAll(PDO::FETCH_COLUMN);

// Récupération des produits avec ou sans filtre
include __DIR__ . '/../Controller/get_all_products.php';

$activeCategory = isset($_GET['category']) ? $_GET['category'] : null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/product.css">
</head>
<body>

<?php include __DIR__ . "../navbar.php"; ?>

<div class="d-flex justify-content-start mb-3">
    <form method="get" action="product.php" class="d-flex">
        <div class="me-2">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="" <?= !$activeCategory ? 'selected' : '' ?>>Toutes les catégories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>" <?= $activeCategory === $cat ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>


    <!-- Grille de produits -->
    <div class="d-flex justify-content-center">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
            <?php if (count($allProducts) > 0): ?>
                <?php foreach ($allProducts as $product): ?>
                    <div class="col">
                        <div class="card produit-card h-100 text-center">
                            <div class="image-container bg-light d-flex justify-content-center align-items-center p-3">
                                <a href="product_details.php?id=<?= urlencode($product['idproducts']) ?>">
                                    <img src="../CSS-Image/Image/<?= htmlspecialchars($product['image']) ?>"
                                         class="img-fluid image-produit"
                                         alt="<?= htmlspecialchars($product['name']) ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h6>
                                <p class="text-muted mb-0"><?= htmlspecialchars($product['price']) ?> CHF</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Aucun produit trouvé pour cette catégorie.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . "../footer.html"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
