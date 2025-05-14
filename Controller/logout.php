<?php
session_start();
session_unset();
session_destroy();
header("Location: ../View/login.php"); // Redirige vers la page de login
exit;
