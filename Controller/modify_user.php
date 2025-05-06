<?php
global $conn;
session_start();
require '../Model/db_connector.php';

if (!isset($_SESSION['idusers'])) {
    header('Location: ../View/login.php');
    exit;
}

$id = $_SESSION['idusers'];
$pseudo = $_POST['pseudo'] ?? null;
$newPassword = $_POST['new_password'] ?? null;
$confirmPassword = $_POST['confirm_password'] ?? null;

$updates = [];
$params = [];

// MAJ pseudo
if (!empty($pseudo)) {
    $updates[] = "nickname = :nickname";
    $params['nickname'] = $pseudo;
    $_SESSION['nickname'] = $pseudo;
}

// MAJ mot de passe
if (!empty($newPassword)) {
    if ($newPassword !== $confirmPassword) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updates[] = "password = :password";
    $params['password'] = $hashedPassword;
}

// MAJ image de profil
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../CSS-Image/Image/';

    // Vérifie si le dossier existe, sinon on le crée
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $originalName = basename($_FILES['profile_image']['name']);
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    // Nom unique pour éviter l’écrasement et inclure le nom d’utilisateur
    $fileName = $_SESSION['nickname'] . '-user-image.' . $ext; // Exemple: 'john_doe-user-image.png'
    $targetPath = $uploadDir . $fileName;

    // Vérifie que le type de fichier est une image autorisée
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (in_array($ext, $allowed)) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
            $updates[] = "profile_image = :profile_image";
            $params['profile_image'] = '../CSS-Image/Image/' . $fileName; // Chemin relatif à la base
            $_SESSION['profile_image'] = $params['profile_image']; // MAJ session
        } else {
            echo "Erreur lors de l’upload de l’image.";
            exit;
        }
    } else {
        echo "Format d’image non autorisé.";
        exit;
    }
}

// Si rien à modifier
if (empty($updates)) {
    echo "Aucune modification détectée.";
    exit;
}

// Exécution de la requête pour mettre à jour les données
$sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE idusers = :id";
$params['id'] = $id;

$stmt = $conn->prepare($sql);
$stmt->execute($params);

// Redirection vers la page du profil
header('Location: ../View/user_profile.php');
exit;
