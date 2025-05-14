<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS-Image/CSS/user_profile.css">
</head>
<body>

<?php include __DIR__ . "../navbar.php"; ?>

<main class="container my-5">
    <h2 class="mb-4">Profil utilisateur</h2>

    <div class="row">
        <div class="col-md-4 text-center">
            <?php
            $image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : '../CSS-Image/Image/default_user.png';
            ?>
            <img src="<?= htmlspecialchars($image) ?>" alt="Image du profil" class="img-thumbnail mb-3" id="profile-pic" style="width: 150px; height: 150px; object-fit: cover;">
        </div>
        <div class="col-md-8">
            <form method="post" action="../Controller/modify_user.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="profile-image" class="form-label">Changer l’image de profil</label>
                    <input type="file" class="form-control" id="profile-image" name="profile_image">
                </div>
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= htmlspecialchars($_SESSION['nickname'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="new-password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="new-password" name="new_password">
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirmer mot de passe</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm_password">
                </div>

                <!-- Conteneur flex pour aligner les boutons horizontalement -->
                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary me-2">Sauvegarder</button>
                    <!-- Bouton de déconnexion -->
                    <a href="../Controller/logout.php" class="btn btn-danger">Se déconnecter</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . "../footer.html"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
