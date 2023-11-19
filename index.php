<?php
//start session
session_start();

//redirect if logged in
if (isset($_SESSION['user'])) {
    header('location:home.php');
}
$pageTitle = "Connexion à mon compte";

require_once('header.php');
?>

<div class="container">
    <div class="row">
        <!-- Formulaire de connexion -->
        <div class="col-md-6">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">J'ai déjà un compte</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="username">Email:</label>
                            <input class="form-control" placeholder="Username" type="text" name="username" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input class="form-control" placeholder="Password" type="password" name="password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
                    </form>
                </div>
                <p><a href="#">Mot de passe oublié?</a><span class="text-muted">(Upcoming fonctionnality)</span></p>
            </div>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="col-md-6">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Je n'ai pas encore de compte</h3>
                </div>
                <div class="panel-body">
                    <form action="process_inscription.php" method="post">
                        <div class="form-group">
                            <label for="firstname">Prénom:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>

                        <div class="form-group">
                            <label for="lastname">Nom:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone:</label>
                            <input type="phone" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirmer le mot de passe:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary btn-block">Créer mon compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>