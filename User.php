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

        $statement = $this->connection->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        } else {
            return false;
        }
    }

    /*public function getUserById($id)
    {
        $statement = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $userData = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        return new self($userData['id'], $userData['username'], $userData['password']);
    }*/
}
