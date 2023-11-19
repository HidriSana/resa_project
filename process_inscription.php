<?php

$pageTitle = "Handling";
require_once('header.php');

$userHandler = new User();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userHandler->createUser($lastname, $firstname, $phone, $email, $password);
    echo '<p>
    Votre compte a été créé avec succès. Veuillez <a href="login.php">vous connecter</a> pour pouvoir voir et réserver nos chambres disponibles.</p>';
}
