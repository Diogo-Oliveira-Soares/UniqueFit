<?php
global $conn;
require_once __DIR__ . '/../Model/db_connector.php';

$stmt = $conn->query("SELECT * FROM products WHERE is_active = 1 ORDER BY RAND() LIMIT 4");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($produits as $produit): ?>
    <div class="col">
        <div class="card produit text-center">
            <a href="product_details.php?id=<?= urlencode($produit['idproducts']) ?>">
            <img src="../CSS-Image/Image/<?= htmlspecialchars($produit['image']) ?: 'no-image.png' ?>" class="card-img-top" alt="<?= htmlspecialchars($produit['name']) ?>">
            </a>
            <div class="card-body">
                <h5 class="card-title fw-bold"><?= htmlspecialchars($produit['name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($produit['price']) ?> CHF</p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
