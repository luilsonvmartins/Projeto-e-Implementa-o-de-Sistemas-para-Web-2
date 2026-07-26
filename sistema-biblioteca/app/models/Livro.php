<?php
class Livro extends Model {

    /** Lista todos os livros com categoria */
    public function todos(): array {
        $sql = "SELECT l.*, c.nome AS categoria_nome
                FROM livros l
                LEFT JOIN categorias c ON l.id_categoria = c.id
                ORDER BY l.titulo ASC";
        return $this->db->query($sql)->fetchAll();
    }

    /** Busca livro por ID com autores */
    public function porId(int $id): ?array {
        $stmt = $this->db->prepare(
            "SELECT l.*, c.nome AS categoria_nome
             FROM livros l
             LEFT JOIN categorias c ON l.id_categoria = c.id
             WHERE l.id = ?"
        );
        $stmt->execute([$id]);
        $livro = $stmt->fetch();
        if (!$livro) return null;

        // Busca autores do livro
        $stmt2 = $this->db->prepare(
            "SELECT a.nome FROM autores a
             INNER JOIN livro_autor la ON a.id = la.id_autor
             WHERE la.id_livro = ?"
        );
        $stmt2->execute([$id]);
        $livro['autores'] = $stmt2->fetchAll(PDO::FETCH_COLUMN);
        return $livro;
    }

    /** Insere novo livro com upload de capa */
    public function inserir(array $d): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO livros (titulo, isbn, ano, sinopse, qtd_total, qtd_disponivel, capa, id_categoria)
             VALUES (:titulo, :isbn, :ano, :sinopse, :qtd_total, :qtd_total, :capa, :id_categoria)"
        );
        return $stmt->execute([
            ':titulo'       => $d['titulo'],
            ':isbn'         => $d['isbn']         ?? null,
            ':ano'          => $d['ano']           ?: null,
            ':sinopse'      => $d['sinopse']       ?? null,
            ':qtd_total'    => (int)$d['qtd_total'],
            ':capa'         => $d['capa']          ?? null,
            ':id_categoria' => $d['id_categoria']  ?: null,
        ]);
    }

    /** Retorna o ID do último registro inserido */
    public function ultimoId(): int { return (int)$this->db->lastInsertId(); }

    /** Vincula autores ao livro */
    public function vincularAutores(int $idLivro, array $idsAutores): void {
        $stmt = $this->db->prepare("INSERT IGNORE INTO livro_autor (id_livro, id_autor) VALUES (?,?)");
        foreach ($idsAutores as $idAutor) { $stmt->execute([$idLivro, (int)$idAutor]); }
    }

    /** Atualiza livro (EP4) */
    public function atualizar(int $id, array $d): bool {
        $stmt = $this->db->prepare(
            "UPDATE livros SET titulo=:titulo, isbn=:isbn, ano=:ano, sinopse=:sinopse,
             qtd_total=:qtd_total, id_categoria=:id_categoria
             WHERE id=:id"
        );
        return $stmt->execute([
            ':titulo'       => $d['titulo'],
            ':isbn'         => $d['isbn']        ?? null,
            ':ano'          => $d['ano']          ?: null,
            ':sinopse'      => $d['sinopse']      ?? null,
            ':qtd_total'    => (int)$d['qtd_total'],
            ':id_categoria' => $d['id_categoria'] ?: null,
            ':id'           => $id,
        ]);
    }

    /** Remove livro (EP4) */
    public function deletar(int $id): bool {
        return $this->db->prepare("DELETE FROM livros WHERE id=?")->execute([$id]);
    }
}
