<?php
global $conn;
session_start();
include '../Model/db_connector.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($mail) || empty($password)) {
        echo "Tous les champs sont requis.";
        exit;
    }

    // Vérifie si l'utilisateur existe
    $stmt = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
    $stmt->execute(['mail' => $mail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        if ($user['email_verified'] == 1) {
            // Authentification réussie
            $_SESSION['idusers'] = $user['idusers'];
            $_SESSION['nickname'] = $user['nickname'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['profile_image'] = $user['profile_image'] ?? null;

            header('Location: ../View/home.php');
            exit;
        } else {
            echo "Veuillez vérifier votre adresse e-mail avant de vous connecter.";
        }
    } else {
        echo "Mail ou mot de passe incorrect.";
    }
}
?>
