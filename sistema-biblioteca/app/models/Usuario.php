<?php
class Usuario extends Model {

    /** Busca usuário por e-mail para autenticação */
    public function porEmail(string $email): ?array {
        $stmt = $this->db->prepare(
            "SELECT * FROM usuarios WHERE email = ? AND ativo = 1 LIMIT 1"
        );
        $stmt->execute([trim($email)]);
        return $stmt->fetch() ?: null;
    }

    /** Busca usuário por ID */
    public function porId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    /** Lista todos os usuários */
    public function todos(): array {
        return $this->db->query(
            "SELECT id, nome, email, perfil, ativo, criado_em FROM usuarios ORDER BY nome"
        )->fetchAll();
    }

    /** Cadastra novo usuário com senha hasheada */
    public function inserir(array $d): bool {
        $hash = password_hash($d['senha'], PASSWORD_BCRYPT);
        $stmt = $this->db->prepare(
            "INSERT INTO usuarios (nome, email, senha, perfil) VALUES (:nome, :email, :senha, :perfil)"
        );
        return $stmt->execute([
            ':nome'   => trim($d['nome']),
            ':email'  => trim($d['email']),
            ':senha'  => $hash,
            ':perfil' => $d['perfil'] ?? 'leitor',
        ]);
    }

    /** Atualiza dados do usuário (sem senha) */
    public function atualizar(int $id, array $d): bool {
        $stmt = $this->db->prepare(
            "UPDATE usuarios SET nome=:nome, email=:email, perfil=:perfil WHERE id=:id"
        );
        return $stmt->execute([
            ':nome'   => trim($d['nome']),
            ':email'  => trim($d['email']),
            ':perfil' => $d['perfil'] ?? 'leitor',
            ':id'     => $id,
        ]);
    }

    /** Altera senha */
    public function alterarSenha(int $id, string $novaSenha): bool {
        $hash = password_hash($novaSenha, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE usuarios SET senha=:senha WHERE id=:id");
        return $stmt->execute([':senha' => $hash, ':id' => $id]);
    }

    /** Ativa ou inativa usuário */
    public function alterarStatus(int $id, int $ativo): bool {
        $stmt = $this->db->prepare("UPDATE usuarios SET ativo=:ativo WHERE id=:id");
        return $stmt->execute([':ativo' => $ativo, ':id' => $id]);
    }

    /** Remove usuário */
    public function deletar(int $id): bool {
        return $this->db->prepare("DELETE FROM usuarios WHERE id=?")->execute([$id]);
    }

    /** Validações de cadastro */
    public function validar(array $d, bool $novoCadastro = true): array {
        $erros = [];
        if (empty(trim($d['nome'] ?? '')))  $erros[] = 'Nome é obrigatório.';
        if (empty(trim($d['email'] ?? ''))) $erros[] = 'E-mail é obrigatório.';
        if (!filter_var($d['email'] ?? '', FILTER_VALIDATE_EMAIL)) $erros[] = 'E-mail inválido.';
        if ($novoCadastro) {
            if (empty($d['senha'])) $erros[] = 'Senha é obrigatória.';
            if (strlen($d['senha'] ?? '') < 6) $erros[] = 'Senha deve ter no mínimo 6 caracteres.';
            if (($d['senha'] ?? '') !== ($d['confirmar_senha'] ?? '')) $erros[] = 'As senhas não conferem.';
        }
        if (!in_array($d['perfil'] ?? '', ['admin','leitor'])) $erros[] = 'Perfil inválido.';
        return $erros;
    }

    /** Verifica se e-mail já está em uso (exceto pelo próprio usuário) */
    public function emailExiste(string $email, int $excluirId = 0): bool {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE email=? AND id != ?");
        $stmt->execute([trim($email), $excluirId]);
        return (bool)$stmt->fetch();
    }
}
