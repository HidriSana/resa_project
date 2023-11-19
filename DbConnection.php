<?php

class DbConnection
{
    private $host = 'localhost';
    private $dbname = 'donkey_hotel';
    private $user = 'root';
    private $password = '';

    protected $connection;

    public function __construct()
    {

        if (!isset($this->connection)) {

            try {
                $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Cannot connect to database server: ' . $e->getMessage();
                exit;
            }
        }

        return $this->connection;
    }
}
