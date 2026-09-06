<?php
function url(string $path = ''): string { return BASE_URL . '/' . ltrim($path, '/'); }
function redirect(string $path): void   { header('Location: ' . url($path)); exit; }
function e(string $value): string       { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }

function flash(string $key): ?string {
    if (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    return null;
}
function setFlash(string $key, string $msg): void { $_SESSION['flash'][$key] = $msg; }

function isLoggedIn(): bool { return isset($_SESSION['usuario_id']); }

function requireLogin(): void {
    if (!isLoggedIn()) {
        setFlash('erro', 'Faça login para continuar.');
        redirect('auth/login');
    }
}

/** Exige perfil específico; redireciona com erro se não tiver permissão */
function requirePerfil(string $perfil): void {
    requireLogin();
    if (($_SESSION['usuario_perfil'] ?? '') !== $perfil) {
        setFlash('erro', 'Acesso negado. Você não tem permissão para esta área.');
        redirect('home/index');
    }
}

/** Retorna true se o usuário logado é admin */
function isAdmin(): bool {
    return ($_SESSION['usuario_perfil'] ?? '') === 'admin';
}
