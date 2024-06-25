<?php
include_once 'DbConfig.php';

class Crud extends DbConfig
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registerUser($username, $password)
    {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (username, password) VALUES (?, ?)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([$username, $hashedPassword]);
    }

    public function loginUser($username, $password)
    {
        $query = "SELECT * FROM user WHERE username = ?";
        $statement = $this->connection->prepare($query);
        $statement->execute([$username]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getData($query)
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function execute($query)
    {
        try {
            $statement = $this->connection->prepare($query);
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id, $table)
    {
        $query = "DELETE FROM $table WHERE id = :id";

        try {
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':id', $id);
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function escape_string($value)
    {

        return $value;
    }
    public function getAllUserNames()
    {
        $query = "SELECT name FROM users";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }

    public function updateUserData($id, $name, $quantity, $category, $pricing, $date)
    {
        $query = "UPDATE users SET name=?, quantity=?, category=?, pricing=?, date=? WHERE id=?";
        $statement = $this->connection->prepare($query);
        return $statement->execute([$name, $quantity, $category, $pricing, $date, $id]);
    }


    public function insertUserWithPricingAndDate($name, $quantity, $category, $pricing, $date)
    {
        $query = "INSERT INTO users (name, quantity, category, pricing, date) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([$name, $quantity, $category, $pricing, $date]);
    }
    public function stockInItem($name, $quantity) {
        try {
            $query = "UPDATE users SET quantity = quantity + :quantity WHERE name = :name";
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function stockOutItem($name, $quantity) {
        try {
            $query = "UPDATE users SET quantity = GREATEST(quantity - :quantity, 0) WHERE name = :name";
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


}
