<?php
spl_autoload_register(function (string $class): void {
    $paths = [APP.'/controllers/'.$class.'.php', APP.'/models/'.$class.'.php'];
    foreach ($paths as $file) { if (file_exists($file)) { require_once $file; return; } }
});
require_once APP . '/helpers.php';
