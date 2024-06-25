<?php
class DbConfig
{
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'test';
    public $connection;

    public function __construct()
    {
        try {

            $dsn = "mysql:host={$this->_host};dbname={$this->_database}";
            $this->connection = new PDO($dsn, $this->_username, $this->_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Cannot connect to database: " . $e->getMessage());
        }
    }
}
