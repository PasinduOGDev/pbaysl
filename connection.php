<?php

class Database {

    public static $connection;

    public static function connect() {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost","root","1234","pbay_db","3306");
        }
    }

    public static function iud($q) {
        Database::connect();
        Database::$connection->query($q);
    }

    public static function search($q) {
        Database::connect();
        $result = Database::$connection->query($q);
        return $result;
    }

}

?>