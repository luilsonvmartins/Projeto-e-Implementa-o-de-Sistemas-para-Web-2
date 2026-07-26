<?php
class Autor extends Model {
    public function todos(): array {
        return $this->db->query("SELECT * FROM autores ORDER BY nome")->fetchAll();
    }
    public function inserir(array $d): bool {
        $stmt = $this->db->prepare("INSERT INTO autores (nome,nacionalidade) VALUES (:nome,:nacionalidade)");
        return $stmt->execute([':nome'=>$d['nome'],':nacionalidade'=>$d['nacionalidade']??null]);
    }
    public function porId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM autores WHERE id=?");
        $stmt->execute([$id]); return $stmt->fetch() ?: null;
    }
}
