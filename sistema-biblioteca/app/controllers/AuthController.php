<?php
class AuthController extends Controller
{
    public function login(?string $param = null): void
    {
        if (isLoggedIn()) redirect('home/index');
        $this->view('auth/login', ['titulo' => 'Login — ' . APP_NAME]);
    }
    public function autenticar(?string $param = null): void
    {
        // Autenticação real será implementada na EP5
        // Por enquanto aceita qualquer login para testar as rotas
        $_SESSION['usuario_id']   = 1;
        $_SESSION['usuario_nome'] = 'Admin';
        $_SESSION['usuario_perfil'] = 'admin';
        setFlash('sucesso', 'Bem-vindo, Admin!');
        redirect('home/index');
    }
    public function logout(?string $param = null): void
    {
        session_destroy();
        redirect('auth/login');
    }
}
