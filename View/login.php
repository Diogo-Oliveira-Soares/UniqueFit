<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/login.css">
</head>

<body>
<?php include __DIR__ . "../navbar.html"; ?>

<div class="form-center-wrapper">
    <main class="form-wrapper">
        <h2 class="text-center mb-4">Connexion</h2>
        <form>
            <div class="mb-3">
                <label for="pseudo" class="form-label">* Pseudo:</label>
                <input type="text" class="form-control" id="pseudo" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">* Mot de passe:</label>
                <input type="password" class="form-control" id="password" required>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
