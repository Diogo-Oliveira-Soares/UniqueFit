<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/register.css">
</head>

<body>
<?php include __DIR__ . "../navbar.php"; ?>

<div class="form-center-wrapper">
    <main class="form-wrapper">
        <h2 class="text-center mb-4">Inscription</h2>
        <form method="POST" action="../Controller/register_action.php">
            <div class="mb-3">
                <label for="nickname" class="form-label">* Pseudo:</label>
                <input type="text" class="form-control" id="nickname" name="nickname" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">* Prénom:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">* Nom:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">* Email:</label>
                <input type="email" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="mb-3">
                <label for="adress" class="form-label">* Adresse Postale:</label>
                <input type="text" class="form-control" id="adress" name="adress" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">* Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">* Confirmer mot de passe:</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-outline-primary">S'inscrire</button>
            </div>
        </form>

        <div class="text-center my-3">
            <hr>
            <span class="text-muted">OR</span>
        </div>

        <p class="text-center">
            si vous avez déjà un compte <a href="login.php">se connecter</a>
        </p>
    </main>
</div>

<?php include __DIR__ . "../footer.html"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
