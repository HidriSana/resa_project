<?php

$pageTitle = "Administration";
require_once('header.php');

?>

<form action="" method="post">
    <label for="roomNumber">Numéro de la chambre:</label>
    <input type="number" id="roomNumber" name="roomNumber" required><br>

    <label for="roomType">Sélectionnez le type de chambre :</label>
    <select id="roomType" name="roomType" required>
        <option value="simple">Chambre Simple</option>
        <option value="double">Chambre Double</option>
        <option value="suite">Suite</option>
    </select></br>

    <label for="totalRooms">Nombre total des chambres de ce type:</label>
    <input type="number" id="totalRooms" name="totalRooms" required><br>

    <input type="submit" value="Ajouter ce nouveau type de chambres">
</form>

<?php

include('footer.php');
