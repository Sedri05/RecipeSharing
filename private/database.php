<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "recepten";
    private $conn;


    function __construct()
    {
        $this->__connect();
    }

    private function __connect(){
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function close() {
        $this->conn->close();
            unset($conn);
    }

    function select(string $query, array $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } finally {
            $this->close();
        }
        return false;
    }

    function select_one(string $query, array $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } finally {
            $this->close();
        }
        return false;
    }

    private function executeStatement($query, $params = [])
    {
        try {
            if (isset($this->conn)){
                $this->__connect();
            }
            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }

            if ($params) {
                $stmt->bind_param($params[0], $params[1]);
            }

            $stmt->execute();

            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function print()
    {
        echo "hey";
    }
}
