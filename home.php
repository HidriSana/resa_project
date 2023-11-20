<?php
//$pageTitle = "Bienvenue chez Donkey Hotel";
ob_start();

session_start();
//return to login/register if not logged in
if (!isset($_SESSION['email']) || (trim($_SESSION['email']) == '')) {
    header('location:index.php');
}
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
                <input type="date" class="form-control" name="checkinDate" id="checkinDate">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="checkoutDate">Date de départ</label>
                <input type="date" class="form-control" name="checkoutDate" id="checkoutDate">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </form>
    <?php

    $allRooms = new Room;

    $checkinDate = isset($_POST['checkinDate']) ? date('Y-m-d', strtotime($_POST['checkinDate'])) : null;
    $checkoutDate = isset($_POST['checkoutDate']) ? date('Y-m-d', strtotime($_POST['checkoutDate'])) : null;

    $availableRooms = $allRooms->getAvailableRooms($checkinDate, $checkoutDate);

    //var_dump($checkinDate);

    if ($availableRooms) {
        echo '<h3>Chambres Disponibles :</h3>';
        foreach ($availableRooms as $room) {
            echo $room['id'] .  ' ' . $room['description'] .  ' ' . $room['pricePerNight'] . '</br>';
        }
    } else {
        echo '<p>Aucune chambre disponible pour les dates spécifiées.</p>';
    }

    ?>
</div>

<?php
$content = ob_get_clean();
include 'template.php';
