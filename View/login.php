<?php
session_start();

// Vérifier si un message d'erreur est dans la session
$error_message = $_SESSION['error_message'] ?? '';
if ($error_message) {
    unset($_SESSION['error_message']); // Supprimer le message d'erreur après l'avoir affiché
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/login.css">
</head>

<body>
<?php include __DIR__ . "../navbar.php"; ?>

<div class="form-center-wrapper">
    <main class="form-wrapper">
        <h2 class="text-center mb-4">Connexion</h2>
        <form method="post" action="../Controller/login_action.php">
            <div class="mb-3">
                <label for="mail" class="form-label">* Email:</label>
                <input type="email" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">* Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-outline-primary">Se connecter</button>
            </div>
        </form>

        <div class="text-center my-3">
            <hr>
            <span class="text-muted">OR</span>
        </div>

        <p class="text-center">
            si vous n'avez pas encore de compte <a href="register.php">S'inscrire</a>
        </p>
    </main>
</div>

<?php include __DIR__ . "../footer.html"; ?>

<!-- Boîte modale d'erreur -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Erreur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $error_message; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Si un message d'erreur existe, afficher la boîte modale
    <?php if ($error_message): ?>
    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
    <?php endif; ?>
</script>

</body>
</html>
