<?php
/**
 * routes/web.php — Sistema de rotas da aplicação
 *
 * Formato das rotas:
 *   GET  /livros           => LivroController@index
 *   GET  /livros/criar     => LivroController@criar
 *   POST /livros/salvar    => LivroController@salvar
 *   ...
 */

// Captura a URL da requisição
$url = $_GET['url'] ?? 'home';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);

// Divide em segmentos: /controller/metodo/parametro
$segments   = explode('/', $url);
$controller = ucfirst(strtolower($segments[0] ?? 'home')) . 'Controller';
$method     = strtolower($segments[1] ?? 'index');
$param      = $segments[2] ?? null;

// Tabela de rotas permitidas (segurança: apenas rotas declaradas funcionam)
$routes = [
    // Página inicial
    'HomeController'      => ['index'],

    // Livros
    'LivroController'     => ['index', 'criar', 'salvar', 'editar', 'atualizar', 'deletar', 'show'],

    // Autores
    'AutorController'     => ['index', 'criar', 'salvar', 'editar', 'atualizar', 'deletar'],

    // Categorias
    'CategoriaController' => ['index', 'criar', 'salvar', 'editar', 'atualizar', 'deletar'],

    // Autenticação
    'AuthController'      => ['login', 'autenticar', 'logout'],
];

// Verifica se a rota existe
if (
    !isset($routes[$controller]) ||
    !in_array($method, $routes[$controller])
) {
    $controller = 'ErrorController';
    $method     = 'notFound';
}

// Instancia o controller e chama o método
$ctrl = new $controller();
$ctrl->$method($param);
