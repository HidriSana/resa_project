<?php
//start session
ob_start();
$pageTitle = 'Bienvenue chez Donkey Hotel';
require_once('files.php');
?>

<div class="container mt-4">
    <h2 class="mb-4">Réservation de Chambre d'Hôtel</h2>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-6">
                <label for="checkinDate" class="form-label">Date d'arrivée</label>
                <input type="date" class="form-control" name="checkinDate" id="checkinDate">
            </div>
            <div class="col-md-6">
                <label for="checkoutDate" class="form-label">Date de départ</label>
                <input type="date" class="form-control" name="checkoutDate" id="checkoutDate">
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </div>
    </form>

    <?php
    $allRooms = new Room;
    $checkinDate = isset($_POST['checkinDate']) ? date('Y-m-d', strtotime($_POST['checkinDate'])) : null;
    $checkoutDate = isset($_POST['checkoutDate']) ? date('Y-m-d', strtotime($_POST['checkoutDate'])) : null;
    $availableRooms = $allRooms->getAvailableRooms($checkinDate, $checkoutDate);

    if ($availableRooms) {
        echo '<h3 class="mt-4 mb-3">Chambres Disponibles :</h3>';
        $count = 0;
        echo '<div class="row d-flex flex-wrap">';
        foreach ($availableRooms as $room) {
    ?>
            <div class="col-md-4 mb-3">
                <div class="card d-flex flex-column h-100">
                    <img src="<?= $room['imagePath']; ?>" class="card-img-top" alt="Image de la chambre">
                    <div class="card-body">
                        <h5 class="card-title"><?= $room['description']; ?></h5>
                        <p class="card-text">Prix par nuit : <?= $room['pricePerNight']; ?></p>
                        <a href="addcart.php?id=<?= $room['id'] ?>" class="btn btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
    <?php
            $count++;
        }
        echo '</div>';
        if ($count == 0) {
            echo '<p class="mt-4">Aucune chambre disponible pour les dates spécifiées.</p>';
        }
    } else {
        echo '<p class="mt-4">Aucune chambre disponible pour les dates spécifiées.</p>';
    }
    ?>
</div>

<?php
$content = ob_get_clean();
include 'template.php';
?>