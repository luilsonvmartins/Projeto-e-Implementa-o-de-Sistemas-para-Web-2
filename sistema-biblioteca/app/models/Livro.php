<?php
class Livro extends Model {

    public function todos(): array {
        return $this->db->query(
            "SELECT l.*, c.nome AS categoria_nome
             FROM livros l
             LEFT JOIN categorias c ON l.id_categoria = c.id
             ORDER BY l.titulo ASC"
        )->fetchAll();
    }

    public function porId(int $id): ?array {
        $stmt = $this->db->prepare(
            "SELECT l.*, c.nome AS categoria_nome
             FROM livros l LEFT JOIN categorias c ON l.id_categoria = c.id
             WHERE l.id = ?"
        );
        $stmt->execute([$id]);
        $livro = $stmt->fetch();
        if (!$livro) return null;
        $stmt2 = $this->db->prepare(
            "SELECT a.id, a.nome FROM autores a
             INNER JOIN livro_autor la ON a.id = la.id_autor
             WHERE la.id_livro = ?"
        );
        $stmt2->execute([$id]);
        $livro['autores'] = $stmt2->fetchAll();
        return $livro;
    }

    public function inserir(array $d): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO livros (titulo,isbn,ano,sinopse,qtd_total,qtd_disponivel,capa,id_categoria)
             VALUES (:titulo,:isbn,:ano,:sinopse,:qtd_total,:qtd_disp,:capa,:cat)"
        );
        return $stmt->execute([
            ':titulo' => trim($d['titulo']),
            ':isbn'   => trim($d['isbn'] ?? '') ?: null,
            ':ano'    => $d['ano'] ?: null,
            ':sinopse'=> trim($d['sinopse'] ?? '') ?: null,
            ':qtd_total' => (int)$d['qtd_total'],
	    ':qtd_disp'  => (int)$d['qtd_total'],
            ':capa'   => $d['capa'] ?? null,
            ':cat'    => $d['id_categoria'] ?: null,
        ]);
    }

    public function ultimoId(): int { return (int)$this->db->lastInsertId(); }

    public function vincularAutores(int $idLivro, array $ids): void {
        $this->db->prepare("DELETE FROM livro_autor WHERE id_livro=?")->execute([$idLivro]);
        $stmt = $this->db->prepare("INSERT IGNORE INTO livro_autor (id_livro,id_autor) VALUES (?,?)");
        foreach ($ids as $id) $stmt->execute([$idLivro, (int)$id]);
    }

    public function atualizar(int $id, array $d): bool {
        $campos = "titulo=:titulo,isbn=:isbn,ano=:ano,sinopse=:sinopse,qtd_total=:qtd,id_categoria=:cat";
        $params = [
            ':titulo' => trim($d['titulo']),
            ':isbn'   => trim($d['isbn'] ?? '') ?: null,
            ':ano'    => $d['ano'] ?: null,
            ':sinopse'=> trim($d['sinopse'] ?? '') ?: null,
            ':qtd'    => (int)$d['qtd_total'],
            ':cat'    => $d['id_categoria'] ?: null,
            ':id'     => $id,
        ];
        if (!empty($d['capa'])) {
            $campos .= ",capa=:capa";
            $params[':capa'] = $d['capa'];
        }
        return $this->db->prepare("UPDATE livros SET $campos WHERE id=:id")->execute($params);
    }

    public function deletar(int $id): bool {
        // Remove capa do disco se existir
        $stmt = $this->db->prepare("SELECT capa FROM livros WHERE id=?");
        $stmt->execute([$id]);
        $livro = $stmt->fetch();
        if ($livro && $livro['capa']) {
            $arquivo = ROOT . '/public/uploads/capas/' . $livro['capa'];
            if (file_exists($arquivo)) unlink($arquivo);
        }
        return $this->db->prepare("DELETE FROM livros WHERE id=?")->execute([$id]);
    }

    public function validar(array $d): array {
        $erros = [];
        if (empty(trim($d['titulo'] ?? '')))   $erros[] = 'Título é obrigatório.';
        if (strlen(trim($d['titulo'] ?? '')) > 200) $erros[] = 'Título deve ter no máximo 200 caracteres.';
        if (!empty($d['isbn']) && strlen($d['isbn']) > 20) $erros[] = 'ISBN inválido (máx. 20 caracteres).';
        if (!empty($d['ano']) && ($d['ano'] < 1000 || $d['ano'] > 2099)) $erros[] = 'Ano inválido.';
        if (empty($d['qtd_total']) || (int)$d['qtd_total'] < 1) $erros[] = 'Quantidade deve ser no mínimo 1.';
        return $erros;
    }
}
