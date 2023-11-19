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
}
