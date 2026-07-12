<?php
class CategoriaController extends Controller
{
    public function index(?string $param = null): void
    {
        requireLogin();
        $this->render('categorias/index', ['titulo' => 'Categorias']);
    }
    public function criar(?string $param = null): void
    {
        requireLogin();
        $this->render('categorias/form', ['titulo' => 'Cadastrar Categoria', 'categoria' => null]);
    }
    public function salvar(?string $param = null): void
    {
        requireLogin();
        setFlash('sucesso', 'Categoria cadastrada! (EP3)');
        redirect('categoria/index');
    }
    public function editar(?string $id = null): void
    {
        requireLogin();
        $this->render('categorias/form', ['titulo' => 'Editar Categoria', 'categoria' => null]);
    }
    public function atualizar(?string $param = null): void
    {
        requireLogin();
        setFlash('sucesso', 'Categoria atualizada! (EP4)');
        redirect('categoria/index');
    }
    public function deletar(?string $id = null): void
    {
        requireLogin();
        setFlash('sucesso', 'Categoria removida! (EP4)');
        redirect('categoria/index');
    }
}
