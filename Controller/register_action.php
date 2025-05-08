<?php

// Inclure la connexion à la base de données
global $conn;
include '../Model/db_connector.php';

// Inclure PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../Controller/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nickname = $_POST['nickname'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user_email = $_POST['mail'];
    $adress = $_POST['adress'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password != $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
        $stmt->execute(['mail' => $user_email]);
        $user = $stmt->fetch();

        if ($user) {
            echo "Cet email est déjà utilisé.";
        } else {
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
                echo "Inscription réussie ! Un e-mail de vérification vous a été envoyé.";
            } catch (Exception $e) {
                echo "Erreur lors de l'envoi du mail : {$mailer->ErrorInfo}";
            }
        }
    }
}
