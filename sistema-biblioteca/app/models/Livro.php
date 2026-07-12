<?php
/**
 * Livro.php — Model da entidade Livro (esqueleto para EP3)
 */

class Livro extends Model
{
    protected string $table = 'livros';

    /** Retorna todos os livros com categoria */
    public function todos(): array
    {
        // Implementado na EP3
        return [];
    }

    /** Busca livro por ID */
    public function porId(int $id): ?array
    {
        // Implementado na EP3
        return null;
    }

    /** Insere novo livro */
    public function inserir(array $dados): bool
    {
        // Implementado na EP3
        return false;
    }

    /** Atualiza livro existente */
    public function atualizar(int $id, array $dados): bool
    {
        // Implementado na EP4
        return false;
    }

    /** Remove livro */
    public function deletar(int $id): bool
    {
        // Implementado na EP4
        return false;
    }
}
