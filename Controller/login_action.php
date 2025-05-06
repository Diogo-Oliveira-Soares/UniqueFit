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
        $_SESSION['idusers'] = $user['idusers'];
        $_SESSION['nickname'] = $user['nickname'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['profile_image'] = $user['profile_image']; // <-- ajout de l'image

        header('Location: ../View/home.php');
        exit;
    } else {
        echo "Mail ou mot de passe incsorrect.";
    }
}
?>
