<?php
// cart_controller.php

if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
} else {
    $cart = [];
}

$total = 0;

// Mise à jour de la quantité ou suppression d'un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $id = $_POST['id'] ?? null;

        // Mise à jour de la quantité
        if ($_POST['action'] === 'update' && isset($_POST['quantity'])) {
            foreach ($cart as &$item) {
                if ($item['id'] === $id) {
                    $item['quantity'] = intval($_POST['quantity']);
                    break;
                }
            }
        }

        // Suppression du produit du panier
        if ($_POST['action'] === 'delete') {
            foreach ($cart as $key => $item) {
                if ($item['id'] === $id) {
                    unset($cart[$key]);
                    break;
                }
            }
        }

        // Mettre à jour le panier dans le cookie
        setcookie('cart', json_encode(array_values($cart)), time() + 30 * 24 * 60 * 60, '/');  // 30 jours
    }
}

return $cart;
?>
