<?php
global $conn;
require_once __DIR__ . '/../Model/db_connector.php';

$stmt = $conn->query("SELECT * FROM products ORDER BY RAND() LIMIT 4");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($produits as $produit): ?>
    <div class="col">
        <div class="card produit text-center">
            <img src="../CSS-Image/Image/<?= htmlspecialchars($produit['image']) ?: 'no-image.png' ?>" class="card-img-top" alt="<?= htmlspecialchars($produit['name']) ?>">
            <div class="card-body">
                <h5 class="card-title fw-bold"><?= htmlspecialchars($produit['name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($produit['price']) ?> CHF</p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
