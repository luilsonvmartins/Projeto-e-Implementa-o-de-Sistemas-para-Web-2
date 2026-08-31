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
                error_log('Erro de conexão com o banco de dados: ' . $e->getMessage());
                if (defined('APP_ENV') && APP_ENV === 'development') {
                    die('<div style="font-family:sans-serif;padding:2rem;color:#991b1b;background:#fee2e2;border-left:4px solid #dc2626;margin:2rem">
                        <strong>Erro de conexão:</strong><br>'.$e->getMessage().'<br><br>Verifique se o XAMPP está rodando e o banco "biblioteca" foi criado.</div>');
                }
                die('<div style="font-family:sans-serif;padding:2rem;color:#991b1b;background:#fee2e2;border-left:4px solid #dc2626;margin:2rem">
                    <strong>Erro no sistema.</strong><br>Não foi possível conectar ao banco de dados. Tente novamente mais tarde.</div>');
            }
        }
        return self::$instance;
    }
}