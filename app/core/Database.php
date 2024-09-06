<?php

class Database {

    private static $host = 'cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com';
    private static $db = 'CinemaManagementSystem'; 
    private static $user = 'nbuser';
    private static $pw = 'cinemasystem0123';

    private static function connect() {
        $pdo = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db .';charset=utf8', self::$user, self::$pw);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }

    public static function query($query, $params = array()) {
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll();
        return $data;
    }
}

?>