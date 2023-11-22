<?php
session_start();
require_once('files.php');

$loggedUser = new User();
if (isset($_SESSION['email'])) {
    $userDetails = $loggedUser->getUserDetails($_SESSION['email']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?= $pageTitle; ?></title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Donkey Hotel</a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Accueil
                            </a>
                        </li>
                        <?php if (isset($_SESSION['email'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Mes réservations
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['email']) && $userDetails['isAdmin'] === 1) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="administration.php">
                                    Administration
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <form class="d-flex me-3">
                        <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>

                    <div>
                        <?php if (!isset($_SESSION['email'])) : ?>
                            <a href="login.php" class="btn btn-light text-dark me-2">Se connecter</a>
                            <a href="register.php" class="btn btn-primary">S'inscrire</a>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['email'])) : ?>
                            <div class="text-white">Bienvenue <?= $userDetails['firstname'] . ' ' . $userDetails['lastname']; ?></div>
                            <a href="logout.php" type="button" class="btn btn-primary">Se déconnecter</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="mt-4">
        <div class="container">
            <!-- Le contenu ici-->
            <?php echo $content; ?>
        </div>
    </main>

    <footer class="mt-4">
        <!-- Votre pied de page ici -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>