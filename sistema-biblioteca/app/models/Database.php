<?php
class Database {
    private static ?PDO $instance = null;
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            require_once ROOT . '/config/database.php';
            $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;
            try {
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                die('<div style="font-family:sans-serif;padding:2rem;color:#991b1b;background:#fee2e2;border-left:4px solid #dc2626;margin:2rem">
                    <strong>Erro de conexão com o banco:</strong><br>' . $e->getMessage() .
                    '<br><br>Verifique se o XAMPP está rodando e se o banco "biblioteca" foi criado.</div>');
            }
        }
        return self::$instance;
    }
}
