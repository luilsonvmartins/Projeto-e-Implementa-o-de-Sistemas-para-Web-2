<?php
class CategoriaController extends Controller {
    public function index(?string $p = null): void {
        requireLogin();
        $cat = new Categoria();
        $this->render('categorias/index', ['titulo'=>'Categorias','categorias'=>$cat->todos()]);
    }
    public function criar(?string $p = null): void {
        requireLogin();
        $this->render('categorias/form', ['titulo'=>'Cadastrar Categoria','categoria'=>null]);
    }
    public function salvar(?string $p = null): void {
        requireLogin();
        if (empty($_POST['nome'])) { setFlash('erro','Nome obrigatório.'); redirect('categoria/criar'); }
        $cat = new Categoria();
        $ok = $cat->inserir($_POST);
        setFlash($ok?'sucesso':'erro', $ok?'Categoria cadastrada!':'Erro ao cadastrar.');
        redirect('categoria/index');
    }
    public function editar(?string $id = null): void {
        requireLogin();
        $cat = new Categoria();
        $c = $cat->porId((int)$id);
        if (!$c) { setFlash('erro','Categoria não encontrada.'); redirect('categoria/index'); }
        $this->render('categorias/form', ['titulo'=>'Editar Categoria','categoria'=>$c]);
    }
    public function atualizar(?string $p = null): void {
        requireLogin(); setFlash('sucesso','Categoria atualizada! (EP4)'); redirect('categoria/index');
    }
    public function deletar(?string $id = null): void {
        requireLogin(); setFlash('sucesso','Categoria removida! (EP4)'); redirect('categoria/index');
    }
}
