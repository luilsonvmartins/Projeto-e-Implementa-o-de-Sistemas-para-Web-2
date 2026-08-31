<?php
class Categoria extends Model {

    public function todos(): array {
        return $this->db->query("SELECT * FROM categorias ORDER BY nome")->fetchAll();
    }

    public function porId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM categorias WHERE id=?");
        $stmt->execute([$id]); return $stmt->fetch() ?: null;
    }

    public function inserir(array $d): bool {
        $stmt = $this->db->prepare("INSERT INTO categorias (nome,descricao) VALUES (:nome,:desc)");
        return $stmt->execute([':nome'=>trim($d['nome']),':desc'=>trim($d['descricao']??'')?: null]);
    }

    public function atualizar(int $id, array $d): bool {
        $stmt = $this->db->prepare("UPDATE categorias SET nome=:nome,descricao=:desc WHERE id=:id");
        return $stmt->execute([':nome'=>trim($d['nome']),':desc'=>trim($d['descricao']??'')?: null,':id'=>$id]);
    }

    public function deletar(int $id): bool {
        return $this->db->prepare("DELETE FROM categorias WHERE id=?")->execute([$id]);
    }

    public function validar(array $d): array {
        $erros = [];
        if (empty(trim($d['nome'] ?? ''))) $erros[] = 'Nome é obrigatório.';
        return $erros;
    }
}
