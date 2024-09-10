<?php

class Database {

    private static $host = 'cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com';
    private static $db = 'CinemaManagementSystem';
    private static $user = 'nbuser';
    private static $pw = 'cinemasystem0123';

    private static $pdo = null;

    private static function connect()
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db . ';charset=utf8', self::$user, self::$pw);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return self::$pdo;
    }

    public static function query($query, $params = array())
    {
        //Open db connection, when this method being triggered
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll();

        //Close db connection when executed the query
        self::close();

        //return result
        return $data;
    }

    public static function close()
    {
        self::$pdo = null;
    }
}
?>