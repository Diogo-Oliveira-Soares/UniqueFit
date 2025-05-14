    <?php
    session_start();

    // S'assurer que l'email est bien présent dans la session
    if (!isset($_SESSION['mail']) || $_SESSION['mail'] !== 'uniquefit.staff@gmail.com') {
        header('Location: home.php');
        exit();
    }

    global $products;
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Vue Administrateur</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../CSS-Image/CSS/admin_view.css">
    </head>
    <body>

    <?php include __DIR__ . "/navbar.php"; ?>

    <!-- Admin View -->
    <main class="container my-5">
        <div class="admin-box p-4 border rounded">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Vue Administrateur</h4>
                <a href="../View/add_products.php">
                    <button class="btn btn-primary">Nouveau</button>
                </a>
            </div>

            <!-- Product List -->
            <?php
            include '../Controller/get_products_admin.php';

            if ($products) {
                foreach ($products as $product) {
                    if (isset($product['is_active']) && $product['is_active'] == 0) {
                        echo '
                        <div class="product-item d-flex justify-content-between align-items-center border p-2 mb-3">
                            <span>' . htmlspecialchars($product['name']) . ' (Désactivé)</span>
                            <div>
                                <a href="../Controller/enable_product.php?id=' . $product['idproducts'] . '">
                                    <button class="btn btn-success btn-sm me-2">Réactiver</button>
                                </a>
                            </div>
                        </div>';
                    } else {
                        echo '
                        <div class="product-item d-flex justify-content-between align-items-center border p-2 mb-3">
                            <span>' . htmlspecialchars($product['name']) . '</span>
                            <div>
                                <a href="../View/modify_product.php?id=' . $product['idproducts'] . '">
                                    <button class="btn btn-secondary btn-sm me-2">Modifier</button>
                                </a>
                                <a href="../Controller/disable_product.php?id=' . $product['idproducts'] . '">
                                    <button class="btn btn-danger btn-sm">Désactiver</button>
                                </a>
                            </div>
                        </div>';
                    }
                }
            } else {
                echo '<p>Aucun produit trouvé.</p>';
            }
            ?>
        </div>
    </main>

    <?php include __DIR__ . "/footer.html"; ?>

    </body>
    </html>
