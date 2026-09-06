<?php
class AuthController extends Controller {

    public function login(?string $p = null): void {
        if (isLoggedIn()) redirect('home/index');
        $this->view('auth/login', ['titulo' => 'Login — ' . APP_NAME]);
    }

    public function autenticar(?string $p = null): void {
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        // Validação básica dos campos
        if (empty($email) || empty($senha)) {
            setFlash('erro', 'Preencha e-mail e senha.');
            redirect('auth/login');
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->porEmail($email);

        // Verifica se o usuário existe e a senha está correta
        if (!$usuario || !password_verify($senha, $usuario['senha'])) {
            setFlash('erro', 'E-mail ou senha incorretos.');
            redirect('auth/login');
        }

        // Verifica se a conta está ativa
        if (!$usuario['ativo']) {
            setFlash('erro', 'Conta inativa. Entre em contato com o administrador.');
            redirect('auth/login');
        }

        // Regenera o ID de sessão para evitar session fixation
        session_regenerate_id(true);

        // Armazena dados na sessão
        $_SESSION['usuario_id']     = $usuario['id'];
        $_SESSION['usuario_nome']   = $usuario['nome'];
        $_SESSION['usuario_perfil'] = $usuario['perfil'];

        setFlash('sucesso', 'Bem-vindo, ' . $usuario['nome'] . '!');
        redirect('home/index');
    }

    public function logout(?string $p = null): void {
        // Limpa sessão completamente
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        redirect('auth/login');
    }
}
