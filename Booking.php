<?php
require_once('DbConnection.php');

class User extends DbConnection
{
    public function __construct()
    {

        parent::__construct();
    }

    public function createBooking($checkinDate, $checkoutDate, $totalPrice, $bookingStatus)
    {
        $statement = $this->connection->prepare("INSERT INTO user (checkinDate, checkoutDate, totalPrice, bookingStatus) VALUES (:lastname,:firstname,:phone,:email,:password)");

        $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->execute();
    }
}
