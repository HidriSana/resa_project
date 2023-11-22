<?php
//start session
ob_start();
session_start();

$id = $_GET['id'];
$cart = $_SESSION['cart'];
$cart = [];

var_dump($cart);

array_push($cart, $id);
var_dump($cart);
/*if (isset($_SESSION['cart'])) {

    $cart = $_SESSION['cart'];

    $_SESSION['cart'] = $cart;
} else {

    $_SESSION['cart'] = $cart;
}

var_dump($cart);*/
