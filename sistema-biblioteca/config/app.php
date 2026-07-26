<?php
define('BASE_URL', 'http://localhost/sistema-biblioteca/public');
define('APP_NAME', 'Sistema de Biblioteca');
define('APP_VERSION', '1.0.0');
define('APP_ENV', 'development');
if (APP_ENV === 'development') { ini_set('display_errors',1); error_reporting(E_ALL); } else {
    ini_set('display_errors', 0);
}
