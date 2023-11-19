<?php
require_once('DbConnection.php');

class Room extends DbConnection
{
    public function __construct()
    {

        parent::__construct();
    }

    public function getAllRooms()
    {
        $result = $this->connection->query("SELECT * FROM room");

        if ($result) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getAvailableRooms($checkinDate, $checkoutDate)
    {
        //I'm making sure that only rooms that are not reserved on chosen dates are shown to the user. It checks user's entries but also if a reservation already exists on chosen dates
        $query = "SELECT *
        FROM room
        WHERE id NOT IN (
            SELECT DISTINCT room_id
            FROM booking
            WHERE :checkinDate BETWEEN checkinDate AND checkoutDate
               OR :checkoutDate BETWEEN checkinDate AND checkoutDate
               OR checkinDate BETWEEN :checkinDate AND :checkoutDate
               OR checkoutDate BETWEEN :checkinDate AND :checkoutDate
        );";

        $statement = $this->connection->prepare($query);
        $statement->bindParam(':checkinDate', $checkinDate, PDO::PARAM_STR);
        $statement->bindParam(':checkoutDate', $checkoutDate, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
