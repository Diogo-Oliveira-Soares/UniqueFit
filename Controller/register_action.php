<?php

// Inclure la connexion à la base de données
global $conn;
include '../Model/db_connector.php';

// Inclure PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../Controller/vendor/autoload.php';

session_start(); // Démarre la session pour gérer les erreurs

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nickname = $_POST['nickname'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user_email = $_POST['mail'];
    $adress = $_POST['adress'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Vérification des mots de passe
    if ($password != $confirm_password) {
        $_SESSION['error_message'] = 'Les mots de passe ne correspondent pas.';
        header('Location: ../View/register.php');
        exit;
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Vérifier si l'email existe déjà
        $stmt = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
        $stmt->execute(['mail' => $user_email]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['error_message'] = 'Cet email est déjà utilisé.';
            header('Location: ../View/register.php');
            exit;
        } else {
            // Insérer les données dans la base de données
            $stmt = $conn->prepare("INSERT INTO users (nickname, firstname, lastname, mail, adress, password, email_verified) 
                                    VALUES (:nickname, :firstname, :lastname, :mail, :adress, :password, 0)");

            $stmt->execute([
                'nickname' => $nickname,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mail' => $user_email,
                'adress' => $adress,
                'password' => $hashed_password
            ]);

            $userId = $conn->lastInsertId();

            // Créer un token de vérification pour l'email
            $token = bin2hex(random_bytes(32));

            $stmt = $conn->prepare("INSERT INTO email_verifications (user_id, token) VALUES (:user_id, :token)");
            $stmt->execute([
                'user_id' => $userId,
                'token' => $token
            ]);

            $verifyUrl = "http://localhost:8081/Controller/verify_email.php?token=" . $token;

            $mailer = new PHPMailer(true);

            try {
                $mailer->isSMTP();
                $mailer->Host = '127.0.0.1'; // ProtonMail Bridge (local)
                $mailer->SMTPAuth = true;
                $mailer->Username = 'No-Reply.UniqueFit@protonmail.ch';
                $mailer->Password = 'hzYd4aFEIdjSVBe8pv1E-g';
                $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailer->Port = 1025;

                // Ignorer les erreurs de certificat auto-signé
                $mailer->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    ]
                ];

                $mailer->CharSet = 'UTF-8';
                $mailer->isHTML(false);

                $mailer->setFrom('No-Reply.UniqueFit@protonmail.ch', 'UniqueFit');
                $mailer->addAddress($user_email, $firstname);
                $mailer->Subject = 'Vérification de votre email';
                $mailer->Body = "Bonjour $firstname,\n\nCliquez sur ce lien pour vérifier votre email :\n$verifyUrl\n\nMerci !";

                $mailer->send();
                $_SESSION['success_message'] = "Inscription réussie ! Un e-mail de vérification vous a été envoyé.";
                header('Location: ../View/register.php');
                exit;
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Erreur lors de l'envoi du mail : {$mailer->ErrorInfo}";
                header('Location: ../View/register.php');
                exit;
            }
        }
    }
}
