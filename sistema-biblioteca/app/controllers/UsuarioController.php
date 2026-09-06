<?php
class UsuarioController extends Controller {

    public function index(?string $p = null): void {
        requirePerfil('admin');
        $m = new Usuario();
        $this->render('usuarios/index', [
            'titulo'   => 'Gerenciar Usuários',
            'usuarios' => $m->todos(),
        ]);
    }

    public function criar(?string $p = null): void {
        requirePerfil('admin');
        $this->render('usuarios/form', [
            'titulo'  => 'Cadastrar Usuário',
            'usuario' => null,
            'erros'   => [],
        ]);
    }

    public function salvar(?string $p = null): void {
        requirePerfil('admin');
        $m     = new Usuario();
        $erros = $m->validar($_POST, true);

        if (!$erros && $m->emailExiste($_POST['email'] ?? '')) {
            $erros[] = 'Este e-mail já está cadastrado.';
        }

        if ($erros) {
            $this->render('usuarios/form', [
                'titulo'  => 'Cadastrar Usuário',
                'usuario' => $_POST,
                'erros'   => $erros,
            ]);
            return;
        }

        $ok = $m->inserir($_POST);
        setFlash($ok ? 'sucesso' : 'erro', $ok ? '✅ Usuário cadastrado!' : '❌ Erro ao cadastrar.');
        redirect('usuario/index');
    }

    public function editar(?string $id = null): void {
        requirePerfil('admin');
        $m = new Usuario();
        $u = $m->porId((int)$id);
        if (!$u) { setFlash('erro','Usuário não encontrado.'); redirect('usuario/index'); }
        $this->render('usuarios/form', [
            'titulo'  => 'Editar Usuário',
            'usuario' => $u,
            'erros'   => [],
        ]);
    }

    public function atualizar(?string $p = null): void {
        requirePerfil('admin');
        $id    = (int)($_POST['id'] ?? 0);
        $m     = new Usuario();
        $erros = $m->validar($_POST, false);

        if (!$erros && $m->emailExiste($_POST['email'] ?? '', $id)) {
            $erros[] = 'Este e-mail já está em uso por outro usuário.';
        }

        if ($erros) {
            $u = array_merge($m->porId($id) ?? [], $_POST);
            $this->render('usuarios/form', ['titulo'=>'Editar Usuário','usuario'=>$u,'erros'=>$erros]);
            return;
        }

        $ok = $m->atualizar($id, $_POST);

        // Troca de senha opcional
        if ($ok && !empty($_POST['nova_senha'])) {
            if (strlen($_POST['nova_senha']) < 6) {
                setFlash('erro', '❌ Nova senha deve ter no mínimo 6 caracteres.');
                redirect('usuario/editar/' . $id);
            }
            if ($_POST['nova_senha'] !== ($_POST['confirmar_nova_senha'] ?? '')) {
                setFlash('erro', '❌ As senhas não conferem.');
                redirect('usuario/editar/' . $id);
            }
            $m->alterarSenha($id, $_POST['nova_senha']);
        }

        setFlash($ok ? 'sucesso' : 'erro', $ok ? '✅ Usuário atualizado!' : '❌ Erro ao atualizar.');
        redirect('usuario/index');
    }

    public function deletar(?string $id = null): void {
        requirePerfil('admin');
        // Impede auto-exclusão
        if ((int)$id === (int)$_SESSION['usuario_id']) {
            setFlash('erro', '❌ Você não pode remover sua própria conta.');
            redirect('usuario/index');
        }
        $ok = (new Usuario())->deletar((int)$id);
        setFlash($ok ? 'sucesso' : 'erro', $ok ? '✅ Usuário removido!' : '❌ Erro ao remover.');
        redirect('usuario/index');
    }

    public function perfil(?string $p = null): void {
        requireLogin();
        $m = new Usuario();
        $u = $m->porId((int)$_SESSION['usuario_id']);
        $this->render('usuarios/perfil', ['titulo' => 'Meu Perfil', 'usuario' => $u]);
    }

    public function alterarSenha(?string $p = null): void {
        requireLogin();
        $id           = (int)$_SESSION['usuario_id'];
        $senhaAtual   = $_POST['senha_atual']        ?? '';
        $novaSenha    = $_POST['nova_senha']          ?? '';
        $confirmar    = $_POST['confirmar_nova_senha']?? '';

        $m       = new Usuario();
        $usuario = $m->porId($id);

        if (!password_verify($senhaAtual, $usuario['senha'])) {
            setFlash('erro', '❌ Senha atual incorreta.');
            redirect('usuario/perfil');
        }
        if (strlen($novaSenha) < 6) {
            setFlash('erro', '❌ Nova senha deve ter no mínimo 6 caracteres.');
            redirect('usuario/perfil');
        }
        if ($novaSenha !== $confirmar) {
            setFlash('erro', '❌ As senhas não conferem.');
            redirect('usuario/perfil');
        }

        $ok = $m->alterarSenha($id, $novaSenha);
        setFlash($ok ? 'sucesso' : 'erro', $ok ? '✅ Senha alterada com sucesso!' : '❌ Erro ao alterar senha.');
        redirect('usuario/perfil');
    }
}
