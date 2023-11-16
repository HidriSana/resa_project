<?php
require_once('_connec.php');

class User
{
    //Attributes
    /*private int $id;
    private string $lastname;
    private string $firstname;
    private int $phone;
    private string $email;
    private string $password;
    private bool $isAdmin;*/
    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function createUser($lastname, $firstname, $phone, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $statement = $this->pdo->prepare("INSERT INTO user (lastname, firstname, phone, email, password) VALUES (:lastname,:firstname,:phone,:email,:password)");

        $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->execute();
    }
}
