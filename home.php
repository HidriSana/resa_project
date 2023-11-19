<?php
$pageTitle = "Bienvenue chez Donkey Hotel";
require_once('header.php');

session_start();
//return to login if not logged in
/*if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}*/
$loggedUser = new User();

var_dump($_SESSION);
