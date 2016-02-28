<?php

class Database {

    private static $db;
    private $connection;

    private function __construct() {
        $this->connection = new MySQLi("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if ($db == null) {
            $db = new Database();
        }
        return $db->connection;
    }
}

?>