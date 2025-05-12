<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées par le formulaire
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $price = floatval($_POST['price'] ?? 0);
    $image = $_POST['image'] ?? '';
    $quantity = intval($_POST['quantity'] ?? 1);
    $couleur = $_POST['couleur'] ?? '';
    $taille = $_POST['taille'] ?? '';

    // Validation des données
    if (!$id || $quantity < 1 || !$couleur || !$taille) {
        $_SESSION['error_message'] = "Veuillez sélectionner une couleur, une taille et une quantité valide.";
        header("Location: ../View/product_details.php?id=" . urlencode($id));
        exit;
    }

    // Créer l'article à ajouter
    $product = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'quantity' => $quantity,
        'couleur' => $couleur,
        'taille' => $taille
    ];

    // Vérifier si le cookie "cart" existe
    if (isset($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
    } else {
        $cart = [];
    }

    $found = false;

    // Vérifier si le produit avec la même couleur et taille est déjà dans le panier
    foreach ($cart as &$item) {
        if ($item['id'] === $id && $item['couleur'] === $couleur && $item['taille'] === $taille) {
            // Si le produit existe déjà, on ajoute la quantité
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    // Si le produit n'est pas trouvé, on l'ajoute au panier
    if (!$found) {
        $cart[] = $product;
    }

    // Enregistrer le panier dans un cookie (expiration après 30 jours)
    setcookie('cart', json_encode($cart), time() + 30 * 24 * 60 * 60, '/');  // 30 jours

    // Message de confirmation
    $_SESSION['success_message'] = "Le produit a été ajouté à votre panier avec succès.";

    // Redirection vers la page du produit
    header("Location: ../View/product_details.php?id=" . urlencode($id));
    exit;
}
