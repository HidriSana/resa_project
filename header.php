<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
</head>

<body>
    <header>
    </header>
    <main>
        <?php
        require_once('files.php');
        //Instanciation de la BDD
        $database = new DbConnection("localhost", "donkey_hotel", "root", "");

        // Instantaciation de PDO
        $pdo = $database->getDbConnection();
