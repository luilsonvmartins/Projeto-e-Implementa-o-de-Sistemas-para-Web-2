<?php
class AutorController extends Controller {
    public function index(?string $p = null): void {
        requireLogin();
        $autor = new Autor();
        $this->render('autores/index', ['titulo'=>'Autores','autores'=>$autor->todos()]);
    }
    public function criar(?string $p = null): void {
        requireLogin();
        $this->render('autores/form', ['titulo'=>'Cadastrar Autor','autor'=>null]);
    }
    public function salvar(?string $p = null): void {
        requireLogin();
        if (empty($_POST['nome'])) { setFlash('erro','Nome obrigatório.'); redirect('autor/criar'); }
        $autor = new Autor();
        $ok = $autor->inserir($_POST);
        setFlash($ok?'sucesso':'erro', $ok?'Autor cadastrado!':'Erro ao cadastrar.');
        redirect('autor/index');
    }
    public function editar(?string $id = null): void {
        requireLogin();
        $autor = new Autor();
        $a = $autor->porId((int)$id);
        if (!$a) { setFlash('erro','Autor não encontrado.'); redirect('autor/index'); }
        $this->render('autores/form', ['titulo'=>'Editar Autor','autor'=>$a]);
    }
    public function atualizar(?string $p = null): void {
        requireLogin();
        setFlash('sucesso','Autor atualizado! (EP4)');
        redirect('autor/index');
    }
    public function deletar(?string $id = null): void {
        requireLogin();
        setFlash('sucesso','Autor removido! (EP4)');
        redirect('autor/index');
    }
}
