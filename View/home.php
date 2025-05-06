<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS-Image/CSS/home.css">
</head>

<body>

<?php include __DIR__ . "../navbar.php"; ?>

<section class="container my-5">
    <h4 class="mb-4">Quelques Suggestions :</h4>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        <?php include __DIR__ . "/../Controller/get_random_products.php"; ?>
    </div>
</section>


<?php include __DIR__ . "../footer.html"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>