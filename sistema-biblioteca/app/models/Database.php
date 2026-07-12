<?php
/**
 * Database.php — Conexão PDO (Singleton)
 */

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            require_once ROOT . '/config/database.php';
            $dsn = 'mysql:host=' . DB_HOST
                 . ';dbname=' . DB_NAME
                 . ';charset=' . DB_CHARSET;
            try {
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                die('Erro na conexão com o banco: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
