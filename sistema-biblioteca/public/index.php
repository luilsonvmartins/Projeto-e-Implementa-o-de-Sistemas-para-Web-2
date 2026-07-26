<?php
define('ROOT', dirname(__DIR__));
define('APP',  ROOT . '/app');
require_once ROOT . '/config/app.php';
require_once ROOT . '/config/autoload.php';
session_start();
require_once ROOT . '/routes/web.php';
