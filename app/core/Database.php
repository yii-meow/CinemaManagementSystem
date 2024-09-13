<?php

namespace App\core;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

trait Database
{
    private static $entityManager = null;

    public static function getEntityManager()
    {
        if (self::$entityManager === null) {
            require_once __DIR__ . '/../../bootstrap.php';
            self::$entityManager = $entityManager;
        }
        return self::$entityManager;
    }

    private function connect()
    {
        $string = "mysql:host=" . DBHOST . ";port=3306;dbname=" . DBNAME;
        $con = new PDO($string, DBUSER, DBPASS);
        return $con;
    }

    public function query($query, $data = [])
    {

        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }

        return false;
    }

    public function get_row($query, $data = [])
    {

        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result[0];
            }
        }

        return false;
    }

}


