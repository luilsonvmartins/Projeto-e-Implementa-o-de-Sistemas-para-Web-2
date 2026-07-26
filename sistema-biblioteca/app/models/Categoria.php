<?php
class Categoria extends Model {
    public function todos(): array {
        return $this->db->query("SELECT * FROM categorias ORDER BY nome")->fetchAll();
    }
    public function inserir(array $d): bool {
        $stmt = $this->db->prepare("INSERT INTO categorias (nome,descricao) VALUES (:nome,:descricao)");
        return $stmt->execute([':nome'=>$d['nome'],':descricao'=>$d['descricao']??null]);
    }
    public function porId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM categorias WHERE id=?");
        $stmt->execute([$id]); return $stmt->fetch() ?: null;
    }
}
