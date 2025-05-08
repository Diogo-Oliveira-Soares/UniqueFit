<?php
global $conn;
require '../Model/db_connector.php';

$token = $_GET['token'] ?? '';

if ($token) {
    // Récupérer le user_id associé au token
    $stmt = $conn->prepare("SELECT user_id FROM email_verifications WHERE token = ?");
    $stmt->execute([$token]);
    $row = $stmt->fetch();

    if ($row) {
        $userId = $row['user_id'];

        // Met à jour la table users
        $updateStmt = $conn->prepare("UPDATE users SET email_verified = 1 WHERE idusers = ?");
        $updateStmt->execute([$userId]);

        // Supprimer le token de la table email_verifications
        $deleteStmt = $conn->prepare("DELETE FROM email_verifications WHERE user_id = ?");
        $deleteStmt->execute([$userId]);

        echo "Votre e-mail a bien été vérifié. <a href='../View/login.php'>Se connecter</a>";
    } else {
        echo "Lien de vérification invalide ou expiré.";
    }
} else {
    echo "Aucun token fourni.";
}
?>
