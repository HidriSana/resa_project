<?php

//$pageTitle = "Connexion à mon compte";
ob_start();

session_start();
$loggingUser = new User();
var_dump($_POST);
if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    $auth = $loggingUser->check_login($email, $password);
    var_dump($auth);
    if (!$auth) {
        $_SESSION['message'] = 'Invalid email or password';
        header('location:index.php');
    } else {
        $_SESSION['email'] = $auth;
        header('location:home.php');
    }
} else {
    $_SESSION['message'] = 'You need to login first';
    header('location:index.php');
}


$content = ob_get_clean();
include 'template.php';
