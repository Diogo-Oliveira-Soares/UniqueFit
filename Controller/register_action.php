<?php

// Inclure la connexion à la base de données
global $conn;
include '../Model/db_connector.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Récupérer les données du formulaire
    $nickname = $_POST['nickname'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $adress = $_POST['adress'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validation simple
    if ($password != $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
        // Sécurisation du mot de passe avec hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Vérifier si l'email existe déjà
        $stmt = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
        $stmt->execute(['mail' => $mail]);
        $user = $stmt->fetch();

        if ($user) {
            echo "Cet email est déjà utilisé.";
        } else {
            // Insertion dans la base de données
            $stmt = $conn->prepare("INSERT INTO users (nickname, firstname, lastname, mail, adress, password) 
                                    VALUES (:nickname, :firstname, :lastname, :mail, :adress, :password)");

            $stmt->execute([
                'nickname' => $nickname,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mail' => $mail,
                'adress' => $adress,
                'password' => $hashed_password
            ]);

            echo "Inscription réussie ! <br>";
            echo "<a href='../View/login.php'>Se connecter</a>";
        }
    }
}

