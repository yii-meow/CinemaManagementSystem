<?php

namespace App\core;
use Doctrine\ORM\EntityManager;

trait Database
{
    private static $entityManager = null;
    private $connection = null; // Property to hold the connection
    private $dbRole = 'regular'; // Default user role (can be dynamic)

    public static function getEntityManager()
    {
        if (self::$entityManager === null) {
            require_once __DIR__ . '/../../bootstrap.php';
            self::$entityManager = $entityManager;
        }
        return self::$entityManager;
    }

    // Function to set the user role dynamically
    public function setRole($role)
    {
        $this->dbRole = $role;
    }

    private function connect()
    {
        global $dbConfigs;
        if ($this->connection === null) {
            $dbConfig = $dbConfigs[$this->dbRole];
            $string = "mysql:host=" . $dbConfig["host"] . ";port=3306;dbname=" . $dbConfig["dbname"];
            $this->connection = new PDO($string, $dbConfig["username"], $dbConfig["password"]);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->connection;
    }

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            $this->closeConnection(); // Close connection after executing query
            if (is_array($result) && count($result)) {
                return $result;
            }
        }

        $this->closeConnection();
        return false;
    }

    public function get_row($query, $data = [])
    {

        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            $this->closeConnection(); // Close connection after executing query
            if (is_array($result) && count($result)) {
                return $result[0];
            }
        }

        $this->closeConnection(); // Ensure connection is closed if no data is found
        return false;
    }


    //Chose the connection as soon as possible function
    private function closeConnection():void
    {
        $this->connection = null; // Destroy the object explicitly
    }


}


