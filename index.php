<?php
//start session
ob_start();
$pageTitle = 'Bienvenue chez Donkey Hotel';
require_once('files.php');
?>

<div class="container mt-4">
    <h2 class="mb-4">Réservation de Chambre d'Hôtel</h2>
    <form action="" method="post">
        <div class="form-row">
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

    if ($availableRooms) {
        echo '<h3 class="mt-4 mb-3">Chambres Disponibles :</h3>';
        $count = 0;
        foreach ($availableRooms as $room) {
            //ce count est uniquement une gestion d'affichage des cartes de chambre par 3  si celles-ci sont bien un multiple de 3 ou pas. Lire commentaires correspondants plus bas, pour  multiple de 3  ou pas
            if ($count % 3 == 0) {
                echo '<div class="row">';
            }
    ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="<?= $room['imagePath']; ?>" class="card-img-top" alt="Image de la chambre">
                    <div class="card-body">
                        <h5 class="card-title"><?= $room['description']; ?></h5>
                        <p class="card-text">Prix par nuit : <?= $room['pricePerNight']; ?></p>
                        <a href="addcart.php?identifiant=<?= $room['id'] ?>" class="btn btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
    <?php
            //Gestion de l'affichage des cartes de room quand celles-ci sont bien un multiple de trois
            $count++;
            if ($count % 3 == 0) {
                echo '</div>';
            }
        }
        //Gestion de celles-ci quand ells ne sont pas un multiple de 3  
        if ($count % 3 != 0) {
            echo '</div>';
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