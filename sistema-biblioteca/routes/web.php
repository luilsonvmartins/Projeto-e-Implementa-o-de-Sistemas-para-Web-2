<?php
$url      = rtrim(filter_var($_GET['url'] ?? 'home', FILTER_SANITIZE_URL), '/');
$segments = explode('/', $url);
$controller = ucfirst(strtolower($segments[0] ?? 'home')) . 'Controller';
$method     = strtolower($segments[1] ?? 'index');
$param      = $segments[2] ?? null;

$routes = [
    'HomeController'      => ['index'],
    'LivroController'     => ['index','criar','salvar','editar','atualizar','deletar','show'],
    'AutorController'     => ['index','criar','salvar','editar','atualizar','deletar'],
    'CategoriaController' => ['index','criar','salvar','editar','atualizar','deletar'],
    'AuthController'      => ['login','autenticar','logout'],
];

if (!isset($routes[$controller]) || !in_array($method, $routes[$controller])) {
    $controller = 'ErrorController'; $method = 'notFound';
}
$ctrl = new $controller();
$ctrl->$method($param);
