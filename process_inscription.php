<?php

$pageTitle = "Handling";
require_once('header.php');

$userHandler = new User($pdo);

var_dump($userHandler);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userHandler->createUser($lastname, $firstname, $phone, $email, $password);
}
