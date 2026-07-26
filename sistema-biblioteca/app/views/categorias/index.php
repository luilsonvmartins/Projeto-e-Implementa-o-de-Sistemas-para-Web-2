<div class="card">
    <div class="card-header"><h2>🏷️ Categorias</h2><a href="<?= url('categoria/criar') ?>" class="btn btn-primary">+ Nova Categoria</a></div>
    <?php if (empty($categorias)): ?>
        <p style="text-align:center;color:#9ca3af;padding:2rem;">Nenhuma categoria cadastrada.</p>
    <?php else: ?>
    <table>
        <thead><tr><th>Nome</th><th>Descrição</th><th>Ações</th></tr></thead>
        <tbody>
        <?php foreach ($categorias as $c): ?>
            <tr>
                <td><strong><?= e($c['nome']) ?></strong></td>
                <td><?= e($c['descricao'] ?? '—') ?></td>
                <td>
                    <a href="<?= url('categoria/editar/'.$c['id']) ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                    <a href="<?= url('categoria/deletar/'.$c['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remover?')">🗑</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
