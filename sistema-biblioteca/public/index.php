<?php
/**
 * index.php — Ponto de entrada único (Front Controller)
 * Todas as requisições HTTP passam por aqui.
 */

define('ROOT', dirname(__DIR__));
define('APP',  ROOT . '/app');

require_once ROOT . '/config/app.php';
require_once ROOT . '/config/autoload.php';

session_start();

require_once ROOT . '/routes/web.php';
