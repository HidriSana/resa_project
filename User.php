<?php
require_once('DbConnection.php');

class User extends DbConnection
{
    public function __construct()
    {

        parent::__construct();
    }
    public function createUser($lastname, $firstname, $phone, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $statement = $this->connection->prepare("INSERT INTO user (lastname, firstname, phone, email, password) VALUES (:lastname,:firstname,:phone,:email,:password)");

        $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->execute();
    }
    public function check_login($email, $password)
    {

        $statement = $this->connection->prepare("SELECT id, password FROM user WHERE email = :email");
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $hashedPasswordFromDB = $row['password'];

            // Vérification du mot de passe haché
            if (password_verify($password, $hashedPasswordFromDB)) {
                return $row['id'];
            }
            return false;
        }
    }

    public function getUserDetails($userId)
    {
        $statement = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        } else {
            return false;
        }
    }
}
