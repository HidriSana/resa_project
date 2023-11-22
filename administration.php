<?php
ob_start();
$pageTitle = "Administration";
require_once('files.php');

if (!isset($_SESSION['email']) || $userDetails['isAdmin'] === 0) :

?>
    <p>Vous n'êtes pas autorisé à accéder à cette page</p>
<?php else : ?>
    <h2>Administration</h2>
<?php endif;

$content = ob_get_clean();
include 'template.php';
?>