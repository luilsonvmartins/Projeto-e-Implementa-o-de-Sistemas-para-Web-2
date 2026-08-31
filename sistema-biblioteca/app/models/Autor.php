<?php
class Autor extends Model {

    public function todos(): array {
        return $this->db->query("SELECT * FROM autores ORDER BY nome")->fetchAll();
    }

    public function porId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM autores WHERE id=?");
        $stmt->execute([$id]); return $stmt->fetch() ?: null;
    }

    public function inserir(array $d): bool {
        $stmt = $this->db->prepare("INSERT INTO autores (nome,nacionalidade) VALUES (:nome,:nac)");
        return $stmt->execute([':nome'=>trim($d['nome']),':nac'=>trim($d['nacionalidade']??'')?: null]);
    }

    public function atualizar(int $id, array $d): bool {
        $stmt = $this->db->prepare("UPDATE autores SET nome=:nome,nacionalidade=:nac WHERE id=:id");
        return $stmt->execute([':nome'=>trim($d['nome']),':nac'=>trim($d['nacionalidade']??'')?: null,':id'=>$id]);
    }

    public function deletar(int $id): bool {
        return $this->db->prepare("DELETE FROM autores WHERE id=?")->execute([$id]);
    }

    public function validar(array $d): array {
        $erros = [];
        if (empty(trim($d['nome'] ?? ''))) $erros[] = 'Nome é obrigatório.';
        if (strlen(trim($d['nome'] ?? '')) > 150) $erros[] = 'Nome deve ter no máximo 150 caracteres.';
        return $erros;
    }
}
