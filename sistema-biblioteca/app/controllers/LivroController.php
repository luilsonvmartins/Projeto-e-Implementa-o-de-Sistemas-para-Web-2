<?php
/**
 * LivroController.php — Gerenciamento de livros
 */

class LivroController extends Controller
{
    public function index(?string $param = null): void
    {
        requireLogin();
        $this->render('livros/index', [
            'titulo' => 'Acervo de Livros',
        ]);
    }

    public function criar(?string $param = null): void
    {
        requireLogin();
        $this->render('livros/form', [
            'titulo' => 'Cadastrar Livro',
            'livro'  => null,
        ]);
    }

    public function salvar(?string $param = null): void
    {
        requireLogin();
        // Lógica de inserção será implementada na EP3
        setFlash('sucesso', 'Livro cadastrado com sucesso! (EP3)');
        redirect('livro/index');
    }

    public function editar(?string $id = null): void
    {
        requireLogin();
        $this->render('livros/form', [
            'titulo' => 'Editar Livro',
            'livro'  => null,
        ]);
    }

    public function atualizar(?string $param = null): void
    {
        requireLogin();
        setFlash('sucesso', 'Livro atualizado! (EP4)');
        redirect('livro/index');
    }

    public function deletar(?string $id = null): void
    {
        requireLogin();
        setFlash('sucesso', 'Livro removido! (EP4)');
        redirect('livro/index');
    }

    public function show(?string $id = null): void
    {
        requireLogin();
        $this->render('livros/show', [
            'titulo' => 'Detalhes do Livro',
            'livro'  => null,
        ]);
    }
}
