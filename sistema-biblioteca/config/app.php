<?php
/**
 * config/app.php — Configurações gerais da aplicação
 */

// URL base da aplicação (ajuste conforme seu ambiente XAMPP)
define('BASE_URL', 'http://localhost/sistema-biblioteca/public');

// Nome da aplicação
define('APP_NAME', 'Sistema de Biblioteca');

// Versão
define('APP_VERSION', '1.0.0');

// Ambiente: 'development' ou 'production'
define('APP_ENV', 'development');

// Exibir erros em desenvolvimento
if (APP_ENV === 'development') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
}
