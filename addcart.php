<?php
//start session
ob_start();
session_start();

if (isset($_SESSION['cart'])) {

    $cart = $_SESSION['cart'];

    $_SESSION['cart'] = $cart;
} else {
    $_SESSION['cart'] = $cart;
}


header('location:index.php');
