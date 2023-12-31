<?php
require_once('DbConnection.php');

class Booking extends DbConnection
{

    public function createBooking($checkinDate, $checkoutDate, $bookingStatus)
    {
        $statement = $this->connection->prepare("INSERT INTO user (checkinDate, checkoutDate) VALUES (:checkinDate,:checkoutDate)");

        $statement->bindParam(':checkingDate', $checkinDate, PDO::PARAM_STR);
        $statement->bindParam(':checkoutDate', $checkoutDate, PDO::PARAM_STR);

        $statement->execute();
    }
}
