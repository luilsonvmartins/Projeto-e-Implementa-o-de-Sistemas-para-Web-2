<div class="card">
    <div class="card-header">
        <h2>📖 Acervo de Livros</h2>
        <a href="<?= url('livro/criar') ?>" class="btn btn-primary">+ Novo Livro</a>
    </div>
    <?php if (empty($livros)): ?>
        <p style="text-align:center;color:#9ca3af;padding:2rem;">Nenhum livro cadastrado. <a href="<?= url('livro/criar') ?>">Cadastrar agora</a></p>
    <?php else: ?>
    <table>
        <thead>
            <tr><th>Capa</th><th>Título</th><th>Categoria</th><th>Disponível</th><th>Total</th><th>Ações</th></tr>
        </thead>
        <tbody>
        <?php foreach ($livros as $l): ?>
            <tr>
                <td>
                    <?php if ($l['capa']): ?>
                        <img src="<?= url('uploads/capas/'.e($l['capa'])) ?>" class="capa-thumb" alt="capa">
                    <?php else: ?>
                        <div class="capa-placeholder">📖</div>
                    <?php endif; ?>
                </td>
                <td>
                    <strong><?= e($l['titulo']) ?></strong>
                    <?php if ($l['isbn']): ?><br><small style="color:#9ca3af">ISBN: <?= e($l['isbn']) ?></small><?php endif; ?>
                </td>
                <td><?= e($l['categoria_nome'] ?? '—') ?></td>
                <td><span class="badge <?= $l['qtd_disponivel']>0?'badge-success':'badge-danger' ?>"><?= $l['qtd_disponivel'] ?></span></td>
                <td><?= $l['qtd_total'] ?></td>
                <td style="white-space:nowrap">
                    <a href="<?= url('livro/show/'.$l['id']) ?>" class="btn btn-secondary btn-sm">👁 Ver</a>
                    <a href="<?= url('livro/editar/'.$l['id']) ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                    <button onclick="confirmarExclusao('<?= url('livro/deletar/'.$l['id']) ?>','<?= e($l['titulo']) ?>')"
                        class="btn btn-danger btn-sm">🗑 Remover</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
