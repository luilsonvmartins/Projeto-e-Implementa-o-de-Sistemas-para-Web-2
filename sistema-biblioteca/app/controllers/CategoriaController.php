<?php
class CategoriaController extends Controller {

    public function index(?string $p = null): void {
        requireLogin();
        $this->render('categorias/index', ['titulo'=>'Categorias','categorias'=>(new Categoria())->todos()]);
    }

    public function criar(?string $p = null): void {
        requireLogin();
        $this->render('categorias/form', ['titulo'=>'Cadastrar Categoria','categoria'=>null,'erros'=>[]]);
    }

    public function salvar(?string $p = null): void {
        requireLogin();
        $m = new Categoria(); $erros = $m->validar($_POST);
        if ($erros) {
            $this->render('categorias/form', ['titulo'=>'Cadastrar Categoria','categoria'=>$_POST,'erros'=>$erros]);
            return;
        }
        $ok = $m->inserir($_POST);
        setFlash($ok?'sucesso':'erro', $ok?'✅ Categoria cadastrada!':'❌ Erro ao cadastrar.');
        redirect('categoria/index');
    }

    public function editar(?string $id = null): void {
        requireLogin();
        $m = new Categoria(); $c = $m->porId((int)$id);
        if (!$c) { setFlash('erro','Categoria não encontrada.'); redirect('categoria/index'); }
        $this->render('categorias/form', ['titulo'=>'Editar Categoria','categoria'=>$c,'erros'=>[]]);
    }

    public function atualizar(?string $p = null): void {
        requireLogin();
        $id = (int)($_POST['id'] ?? 0);
        $m  = new Categoria(); $erros = $m->validar($_POST);
        if ($erros) {
            $this->render('categorias/form', ['titulo'=>'Editar Categoria','categoria'=>array_merge($m->porId($id)??[],$_POST),'erros'=>$erros]);
            return;
        }
        $ok = $m->atualizar($id, $_POST);
        setFlash($ok?'sucesso':'erro', $ok?'✅ Categoria atualizada!':'❌ Erro ao atualizar.');
        redirect('categoria/index');
    }

    public function deletar(?string $id = null): void {
        requireLogin();
        $ok = (new Categoria())->deletar((int)$id);
        setFlash($ok?'sucesso':'erro', $ok?'✅ Categoria removida!':'❌ Erro ao remover.');
        redirect('categoria/index');
    }
}
