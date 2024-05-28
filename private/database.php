<?php

class Database
{
    private $servername;
    private $username;
    private $password;
    private $database;
    private $conn;
    private $pepper;


    function __construct()
    {
        $config = require("config.php");
        $this->servername = $config["servername"];
        $this->username = $config["username"];
        $this->password = $config["password"];
        $this->database = $config["database"];
        $this->pepper = $config["pepper"];
        $this->__connect();
    }

    private function __connect()
    {
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function validateArray(array $params = [])
    {
        for ($i = 0; $i < count($params); $i++) {
            $params[$i] = trim($params[$i]);
            $params[$i] = stripslashes($params[$i]);
            $params[$i] = htmlspecialchars($params[$i]);
        }
        return $params;
    }

    function close()
    {
        try {
            @$this->conn->close();
        } catch (Exception $e) {
            //Do nothing
        } finally {
            unset($this->conn);
        }
    }

    function insert(string $query, $params = [], $close = true)
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $stmt->close();

            return mysqli_insert_id($this->conn);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } finally {
            if ($close)
                $this->close();
        }
        return false;
    }


    function insert_if_not_exist(string $query, $params = [], $close = true)
    {
        try {
            $result = $this->select("");
            if (count($result) == 0) {
                $stmt = $this->executeStatement($query, $params);
            }
            $stmt->close();

            return mysqli_insert_id($this->conn);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } finally {
            if ($close)
                $this->close();
        }
        return false;
    }

    function update(string $query, $params = [], $close = true)
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $stmt->close();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } finally {
            if ($close)
                $this->close();
        }
        return false;
    }

    function delete(string $query, $params = [], $close = true)
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $stmt->close();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } finally {
            if ($close)
                $this->close();
        }
        return false;
    }

    function select(string $query, array $params = [], $close = true)
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } finally {
            if ($close)
                $this->close();
        }
        return false;
    }

    function select_one(string $query, array $params = [], $close = true)
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } finally {
            if ($close)
                $this->close();
        }
        return false;
    }

    private function executeStatement($query, $params = [])
    {
        try {
            if (!isset($this->conn)) {
                $this->__connect();
            }
            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }

            if ($params) {
                $stmt->bind_param($params[0], ...$this->validateArray($params[1]));
            }
            $stmt->execute();

            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            $this->close();
        }
    }

    function check_password($password, $hashed)
    {
        $salt = explode(".", $hashed)[0];
        $pd_hash = hash_hmac("sha512", $salt . $password, $this->pepper);
        return $salt . "." . $pd_hash === $hashed;
    }

    function hash_password($password)
    {
        $salt = bin2hex(random_bytes(32));
        $pd_hash = hash_hmac("sha512", $salt . $password, $this->pepper);
        return $salt . "." . $pd_hash;
    }

    function get_image($recept_id)
    {
        $img = "Image Failed to Load";
        $exts = array('bmp', 'png', 'jpg', 'jpeg', 'webp');
        foreach ($exts as $ext) {
            //echo $_SERVER["DOCUMENT_ROOT"] . '/img' . "/" . $recept_id . "." . $ext;
            if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/img' . "/" . $recept_id . "." . $ext)) {
                $img = "/img/" . $recept_id . "." . $ext;
            }
        }
        return $img;
    }

    public function print()
    {
        echo "hey";
    }
}
