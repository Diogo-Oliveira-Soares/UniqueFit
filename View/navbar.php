<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>navbar UniqueFit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/navbar.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white navbar-custom px-4">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <a href="home.php"><img src="../CSS-Image/Image/logo.png" alt="Logo" class="image-logo me-3"></a>
            <span class="slogan">Exprime ton style, sois Unique</span>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="product.php" class="btn btn-outline-dark">produits</a>
            <a href="cart.php" class="btn btn-outline-dark">panier</a>

            <?php if (isset($_SESSION['idusers'])): ?>
                <a href="../View/user_profile.php" class="d-flex align-items-center text-decoration-none">
                    <?php
                    $image = !empty($_SESSION['profile_image']) ? htmlspecialchars($_SESSION['profile_image']) : '../CSS-Image/Image/default_user.png';
                    ?>
                    <img src="<?= $image ?>" alt="Profil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                    <span class="ms-2 fw-medium text-dark"><?= htmlspecialchars($_SESSION['nickname']) ?></span>
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-dark">Se Connecter</a>
                <a href="register.php" class="btn btn-outline-primary">S'inscrire</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
</body>
</html>
