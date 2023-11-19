<?php

$pageTitle = "Connexion à mon compte";
require_once('header.php');

session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    if (empty($email)) {

        header("Location: index.php?error=Email required");

        exit();
    } else if (empty($pass)) {

        header("Location: index.php?error=Password required");

        exit();
    } else {

        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['user_name'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: home.php");

                exit();
            } else {

                header("Location: index.php?error=Incorect User name or password");

                exit();
            }
        } else {

            header("Location: index.php?error=Incorect User name or password");

            exit();
        }
    }
} else {

    header("Location: index.php");

    exit();
}
