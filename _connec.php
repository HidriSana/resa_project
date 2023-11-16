<?php

class DbConnection
{
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $pdo;

    public function __construct($host, $dbname, $user, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        //I want this private function to connect to database when I instantiate
        $this->dbConnect();
    }

    private function dbConnect()
    {
        try {
            $this->pdo = new pdo("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connexion to database failed: " . $e->getMessage());
        }
    }
    public function getDbConnection()
    {
        return $this->pdo;
    }

    public function closeDbConnection(): void
    {
        $this->pdo = null;
    }
}
