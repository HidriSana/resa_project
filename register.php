<?php

$pageTitle = "Création de mon compte";
require_once('header.php');

?>

<form action="process_inscription.php" method="post">
    <label for="firstname">Prénom:</label>
    <input type="text" id="firstname" name="firstname" required><br>

    <label for="lastname">Nom:</label>
    <input type="text" id="lastname" name="lastname" required><br>

    <label for="phone">Téléphone:</label>
    <input type="phone" id="phone" name="phone" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required><br>

    <label for="confirm_password">Confirmer le mot de passe:</label>
    <input type="password" id="confirm_password" name="confirm_password"><br>

    <input type="submit" value="Créer mon compte">
</form>

<p>Vous avez déjà un compte? <a href="login.php">Connectez-vous ici</a>.</p>

<?php

include('footer.php');
