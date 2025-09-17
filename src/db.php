<?php
class DB
{
    private static $pdo;

    public static function getConnection()
    {
        if (!self::$pdo) {
            $host = "db";
            $db   = "toplist_db";
            $user = "user";
            $pass = "userpass";
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            self::$pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }
}
