<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données du formulaire
    $id = $_POST['id'] ?? null;
    $name = htmlspecialchars($_POST['name'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $image = htmlspecialchars($_POST['image'] ?? '');
    $quantity = intval($_POST['quantity'] ?? 1);
    $couleur = htmlspecialchars($_POST['couleur'] ?? '');
    $taille = htmlspecialchars($_POST['taille'] ?? '');

    // Récupération de la personnalisation (texte et image)
    $personnalisation = htmlspecialchars($_POST['personnalisation'] ?? '');
    $image_personnalisation = htmlspecialchars($_POST['image_personnalisation'] ?? '');

    // Validation des données
    if (!$id || $quantity < 1 || !$couleur || !$taille) {
        $_SESSION['error_message'] = "Veuillez sélectionner une couleur, une taille et une quantité valides.";
        header("Location: ../View/product_details.php?id=" . urlencode($id));
        exit;
    }

    // Création de l'article à ajouter
    $product = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'quantity' => $quantity,
        'couleur' => $couleur,
        'taille' => $taille,
        'personnalisation' => $personnalisation,
        'image_personnalisation' => $image_personnalisation
    ];

    // Récupération ou initialisation du panier depuis le cookie
    $cart = [];
    if (isset($_COOKIE['cart'])) {
        $decoded = json_decode($_COOKIE['cart'], true);
        if (is_array($decoded)) {
            $cart = $decoded;
        }
    }

    $found = false;

    // Mise à jour de la quantité si le produit existe déjà avec les mêmes attributs
    foreach ($cart as &$item) {
        if (
            $item['id'] === $id &&
            $item['couleur'] === $couleur &&
            $item['taille'] === $taille &&
            ($item['personnalisation'] ?? '') === $personnalisation &&
            ($item['image_personnalisation'] ?? '') === $image_personnalisation
        ) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    // Ajout du nouveau produit si non trouvé
    if (!$found) {
        $cart[] = $product;
    }

    // Enregistrement du panier dans un cookie (30 jours)
    setcookie('cart', json_encode($cart), time() + (30 * 24 * 60 * 60), '/', '', false, true);

    // Message de succès
    $_SESSION['success_message'] = "Le produit a été ajouté à votre panier avec succès.";

    // Redirection vers la page du produit
    header("Location: ../View/product_details.php?id=" . urlencode($id));
    exit;
}
