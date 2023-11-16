<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $title ?></title>

</head>

<body>
    <header>
        <p>Hello</p>
    </header>

    <?php
    require_once('_connec.php');
    $database = new DbConnection("localhost", "donkey_hotel", "root", "");

    // Obtention de l'instance de PDO (la connexion à la base de données)
    $pdo = $database->getDbConnection();

    var_dump($database);
