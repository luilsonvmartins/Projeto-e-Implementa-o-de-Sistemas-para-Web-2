<div class="card">
    <div class="card-header">
        <h2>👥 Gerenciar Usuários</h2>
        <a href="<?= url('usuario/criar') ?>" class="btn btn-primary">+ Novo Usuário</a>
    </div>
    <?php if (empty($usuarios)): ?>
        <p style="text-align:center;color:#9ca3af;padding:2rem;">Nenhum usuário cadastrado.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Perfil</th><th>Status</th><th>Ações</th></tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td style="color:#9ca3af;width:40px"><?= $u['id'] ?></td>
                <td><strong><?= e($u['nome']) ?></strong></td>
                <td><?= e($u['email']) ?></td>
                <td>
                    <span class="badge <?= $u['perfil']==='admin' ? 'badge-warning' : 'badge-success' ?>">
                        <?= $u['perfil'] ?>
                    </span>
                </td>
                <td>
                    <span class="badge <?= $u['ativo'] ? 'badge-success' : 'badge-danger' ?>">
                        <?= $u['ativo'] ? 'Ativo' : 'Inativo' ?>
                    </span>
                </td>
                <td style="white-space:nowrap">
                    <a href="<?= url('usuario/editar/'.$u['id']) ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                    <?php if ($u['id'] != $_SESSION['usuario_id']): ?>
                    <form method="POST" action="<?= url('usuario/deletar/'.$u['id']) ?>" style="display:inline"
                          onsubmit="return confirm('Remover usuário <?= e($u['nome']) ?>?')">
                        <button type="submit" class="btn btn-danger btn-sm">🗑</button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
