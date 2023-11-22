<?php
ob_start();
require_once('files.php');
?>
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
</div>
</div>
</div>
<?php

$content = ob_get_clean();
include 'template.php';

?>