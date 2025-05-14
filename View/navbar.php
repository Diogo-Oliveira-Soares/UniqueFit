<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$image = !empty($_SESSION['profile_image']) ? htmlspecialchars($_SESSION['profile_image']) : '../CSS-Image/Image/default_user.png';
?>

<head>
    <meta charset="UTF-8">
    <title>navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/navbar.css">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-white navbar-custom px-4">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <a href="home.php"><img src="../CSS-Image/Image/logo.png" alt="Logo" class="image-logo me-3"></a>
            <span class="slogan">Exprime ton style, sois Unique</span>
        </div>

        <!-- Bouton Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu principal -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Panier</a>
                </li>

                <?php if (isset($_SESSION['idusers'])): ?>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center" href="../View/user_profile.php">
                            <img src="<?= $image ?>" alt="Profil" class="rounded-circle"
                                 style="width: 30px; height: 30px; object-fit: cover; margin-right: 8px;">
                            <?= htmlspecialchars($_SESSION['nickname']) ?>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['mail']) && $_SESSION['mail'] === 'uniquefit.staff@gmail.com'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../View/admin_view.php">Admin</a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Se Connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">S'inscrire</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
