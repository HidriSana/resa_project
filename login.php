<?php
//start session
ob_start();

//redirect if logged in
if (isset($_SESSION['user'])) {
    header('location:home.php');
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="login-panel panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Connexion à mon compte</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="login.php">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control" placeholder="Email" type="email" name="email" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe:</label>
                        <input class="form-control" placeholder="Mot de passe" type="password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
                </form>
                <?php
                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-info text-center">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
            </div>
        </div>
        <p><a href="#">Mot de passe oublié?</a><span class="text-muted">(Upcoming fonctionnality)</span></p>
        <p><a href="register.php">Je n'ai pas encore de compte</a></p>
    </div>
    <?php
    $content = ob_get_clean();
    include 'template.php';
