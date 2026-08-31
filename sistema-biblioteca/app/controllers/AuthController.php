<?php
class AuthController extends Controller {
    public function login(?string $p = null): void {
        if (isLoggedIn()) redirect('home/index');
        $this->view('auth/login', ['titulo'=>'Login — '.APP_NAME]);
    }
    public function autenticar(?string $p = null): void {
        $_SESSION['usuario_id']     = 1;
        $_SESSION['usuario_nome']   = 'Admin';
        $_SESSION['usuario_perfil'] = 'admin';
        setFlash('sucesso','Bem-vindo!');
        redirect('home/index');
    }
    public function logout(?string $p = null): void { session_destroy(); redirect('auth/login'); }
}
