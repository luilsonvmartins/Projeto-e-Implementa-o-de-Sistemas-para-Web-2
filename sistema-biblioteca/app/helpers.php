<?php
/**
 * app/helpers.php — Funções utilitárias globais
 */

/**
 * Gera URL absoluta a partir de um caminho relativo.
 * Uso: url('livros/criar')
 */
function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Redireciona para uma URL e encerra o script.
 */
function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

/**
 * Escapa string para exibição segura em HTML.
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Retorna e limpa uma flash message da sessão.
 */
function flash(string $key): ?string
{
    if (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    return null;
}

/**
 * Define uma flash message na sessão.
 */
function setFlash(string $key, string $message): void
{
    $_SESSION['flash'][$key] = $message;
}

/**
 * Verifica se o usuário está autenticado.
 */
function isLoggedIn(): bool
{
    return isset($_SESSION['usuario_id']);
}

/**
 * Redireciona para login se não autenticado.
 */
function requireLogin(): void
{
    if (!isLoggedIn()) {
        setFlash('erro', 'Faça login para continuar.');
        redirect('auth/login');
    }
}
