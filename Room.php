<?php
require_once('_connec.php');

class Room
{

    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function createRoom(string $roomNumber, string $roomType, string $pricePerNight, bool $isAvailable, int $availableRooms, int $reservedRooms, int $totalRooms)
    {

        $statement = $this->pdo->prepare("INSERT INTO room (roomNumber, roomType, pricePerNight, isAvailable, availableRooms, reservedRooms, totalRooms) VALUES (:roomNumber,:roomType,:pricePerNight, :isAvailable, :availableRooms, :reservedRooms, :totalRooms)");

        $statement->bindParam(':roomNumber', $roomNumber, PDO::PARAM_INT);
        $statement->bindParam(':roomType', $roomType, PDO::PARAM_STR);
        $statement->bindParam(':pricePerNight', $pricePerNight, PDO::PARAM_STR); // Decimal en param data type  n'existe pas
        $statement->bindParam(':isAvailable', $isAvailable, PDO::PARAM_BOOL);
        $statement->bindParam(':availableRooms', $availableRooms, PDO::PARAM_INT);
        $statement->bindParam(':reservedRooms', $reservedRooms, PDO::PARAM_INT);
        $statement->bindParam(':totalRooms', $totalRooms, PDO::PARAM_INT);


        $statement->execute();
    }
}
