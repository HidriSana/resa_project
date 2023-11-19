<?php
$pageTitle = "Bienvenue chez Donkey Hotel";
require_once('header.php');

session_start();
//return to login if not logged in
/*if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}*/
$loggedUser = new User();

//var_dump($_SESSION);


$userDetails = $loggedUser->getUserDetails($_SESSION['email']);
//var_dump($userDetails);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2>Bienvenue <?php echo $userDetails['firstname'] . ' ' . $userDetails['lastname']; ?></h2>

            <a href="logout.php" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span> Me déconnecter</a>
        </div>
    </div>
</div>

<div class="container mt-4">

    <h2>Réservation de Chambre d'Hôtel</h2>
    <form action="" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputTypeChambre">Type de Chambre</label>
                <select id="inputTypeChambre" class="form-control">
                    <option selected>Choisissez le type de chambre...</option>
                    <option>Simple</option>
                    <option>Double</option>
                    <option>Deluxe</option>
                    <option>Suite Royale</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="checkinDate">Date d'arrivée</label>
                <input type="date" class="form-control" id="checkinDate">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="checkoutDate">Date de départ</label>
                <input type="date" class="form-control" id="checkoutDate">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $allRooms = new Room;

        $checkinDate = date('Y-m-d', strtotime($_POST['checkinDate']));
        $checkoutDate = date('Y-m-d', strtotime($_POST['checkoutDate']));

        $availableRooms = $allRooms->getAvailableRooms($checkinDate, $checkoutDate);
        var_dump($checkinDate);
        if ($availableRooms) {
            echo '<h3>Chambres Disponibles :</h3>';
            echo '<ul>';
            foreach ($availableRooms as $room) {
                echo '<li>' . $room['id'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Aucune chambre disponible pour les dates spécifiées.</p>';
        }
    }
    ?>
</div>


<?php
require_once('footer.php');
?>