<?php
class AutorController extends Controller
{
    public function index(?string $param = null): void
    {
        requireLogin();
        $this->render('autores/index', ['titulo' => 'Autores']);
    }
    public function criar(?string $param = null): void
    {
        requireLogin();
        $this->render('autores/form', ['titulo' => 'Cadastrar Autor', 'autor' => null]);
    }
    public function salvar(?string $param = null): void
    {
        requireLogin();
        setFlash('sucesso', 'Autor cadastrado! (EP3)');
        redirect('autor/index');
    }
    public function editar(?string $id = null): void
    {
        requireLogin();
        $this->render('autores/form', ['titulo' => 'Editar Autor', 'autor' => null]);
    }
    public function atualizar(?string $param = null): void
    {
        requireLogin();
        setFlash('sucesso', 'Autor atualizado! (EP4)');
        redirect('autor/index');
    }
    public function deletar(?string $id = null): void
    {
        requireLogin();
        setFlash('sucesso', 'Autor removido! (EP4)');
        redirect('autor/index');
    }
}
