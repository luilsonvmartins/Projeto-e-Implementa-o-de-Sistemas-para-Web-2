<div class="card">
    <div class="card-header"><h2>✍️ Autores</h2><a href="<?= url('autor/criar') ?>" class="btn btn-primary">+ Novo Autor</a></div>
    <?php if (empty($autores)): ?>
        <p style="text-align:center;color:#9ca3af;padding:2rem;">Nenhum autor cadastrado.</p>
    <?php else: ?>
    <table>
        <thead><tr><th>#</th><th>Nome</th><th>Nacionalidade</th><th>Ações</th></tr></thead>
        <tbody>
        <?php foreach ($autores as $a): ?>
            <tr>
                <td style="color:#9ca3af;width:40px"><?= $a['id'] ?></td>
                <td><strong><?= e($a['nome']) ?></strong></td>
                <td><?= e($a['nacionalidade'] ?? '—') ?></td>
                <td style="white-space:nowrap">
                    <a href="<?= url('autor/editar/'.$a['id']) ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                    <button onclick="confirmarExclusao('<?= url('autor/deletar/'.$a['id']) ?>','<?= e($a['nome']) ?>')"
                        class="btn btn-danger btn-sm">🗑 Remover</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
