<?php
class AutorController extends Controller {

    public function index(?string $p = null): void {
        requireLogin();
        $this->render('autores/index', ['titulo'=>'Autores','autores'=>(new Autor())->todos()]);
    }

    public function criar(?string $p = null): void {
        requireLogin();
        $this->render('autores/form', ['titulo'=>'Cadastrar Autor','autor'=>null,'erros'=>[]]);
    }

    public function salvar(?string $p = null): void {
        requireLogin();
        $m = new Autor(); $erros = $m->validar($_POST);
        if ($erros) {
            $this->render('autores/form', ['titulo'=>'Cadastrar Autor','autor'=>$_POST,'erros'=>$erros]);
            return;
        }
        $ok = $m->inserir($_POST);
        setFlash($ok?'sucesso':'erro', $ok?'✅ Autor cadastrado!':'❌ Erro ao cadastrar.');
        redirect('autor/index');
    }

    public function editar(?string $id = null): void {
        requireLogin();
        $m = new Autor(); $a = $m->porId((int)$id);
        if (!$a) { setFlash('erro','Autor não encontrado.'); redirect('autor/index'); }
        $this->render('autores/form', ['titulo'=>'Editar Autor','autor'=>$a,'erros'=>[]]);
    }

    public function atualizar(?string $p = null): void {
        requireLogin();
        $id = (int)($_POST['id'] ?? 0);
        $m  = new Autor(); $erros = $m->validar($_POST);
        if ($erros) {
            $this->render('autores/form', ['titulo'=>'Editar Autor','autor'=>array_merge($m->porId($id)??[],$_POST),'erros'=>$erros]);
            return;
        }
        $ok = $m->atualizar($id, $_POST);
        setFlash($ok?'sucesso':'erro', $ok?'✅ Autor atualizado!':'❌ Erro ao atualizar.');
        redirect('autor/index');
    }

    public function deletar(?string $id = null): void {
        requireLogin();
        $ok = (new Autor())->deletar((int)$id);
        setFlash($ok?'sucesso':'erro', $ok?'✅ Autor removido!':'❌ Erro ao remover.');
        redirect('autor/index');
    }
}
