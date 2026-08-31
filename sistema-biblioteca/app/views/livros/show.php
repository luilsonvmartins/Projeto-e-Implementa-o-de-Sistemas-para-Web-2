<div class="card" style="max-width:700px;margin:0 auto;">
    <div class="card-header">
        <h2>📖 <?= e($livro['titulo']) ?></h2>
        <div style="display:flex;gap:.5rem;">
            <a href="<?= url('livro/editar/'.$livro['id']) ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
            <button onclick="confirmarExclusao('<?= url('livro/deletar/'.$livro['id']) ?>','<?= e($livro['titulo']) ?>')"
                class="btn btn-danger btn-sm">🗑 Remover</button>
            <a href="<?= url('livro/index') ?>" class="btn btn-secondary btn-sm">← Voltar</a>
        </div>
    </div>
    <div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
        <div>
            <?php if ($livro['capa']): ?>
                <img src="<?= url('uploads/capas/'.e($livro['capa'])) ?>" style="width:120px;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,.2)">
            <?php else: ?>
                <div style="width:120px;height:160px;background:#e5e7eb;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:3rem;">📖</div>
            <?php endif; ?>
        </div>
        <div style="flex:1;">
            <table style="font-size:.9rem;">
                <tr><td style="font-weight:600;width:130px;padding:.35rem 0;">ISBN</td><td><?= e($livro['isbn']??'—') ?></td></tr>
                <tr><td style="font-weight:600;padding:.35rem 0;">Ano</td><td><?= e($livro['ano']??'—') ?></td></tr>
                <tr><td style="font-weight:600;padding:.35rem 0;">Categoria</td><td><?= e($livro['categoria_nome']??'—') ?></td></tr>
                <tr><td style="font-weight:600;padding:.35rem 0;">Autores</td>
                    <td><?= !empty($livro['autores']) ? e(implode(', ', array_column($livro['autores'],'nome'))) : '—' ?></td></tr>
                <tr><td style="font-weight:600;padding:.35rem 0;">Disponíveis</td>
                    <td><span class="badge <?= $livro['qtd_disponivel']>0?'badge-success':'badge-danger' ?>">
                        <?= $livro['qtd_disponivel'] ?> / <?= $livro['qtd_total'] ?></span></td></tr>
            </table>
            <?php if ($livro['sinopse']): ?>
                <div style="margin-top:1rem;">
                    <strong style="font-size:.88rem;color:#374151;">Sinopse</strong>
                    <p style="margin-top:.4rem;color:#6b7280;font-size:.9rem;line-height:1.6;"><?= nl2br(e($livro['sinopse'])) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
