<div class="card">
    <div class="card-header"><h2>✍️ Autores</h2><a href="<?= url('autor/criar') ?>" class="btn btn-primary">+ Novo Autor</a></div>
    <?php if (empty($autores)): ?>
        <p style="text-align:center;color:#9ca3af;padding:2rem;">Nenhum autor cadastrado.</p>
    <?php else: ?>
    <table>
        <thead><tr><th>Nome</th><th>Nacionalidade</th><th>Ações</th></tr></thead>
        <tbody>
        <?php foreach ($autores as $a): ?>
            <tr>
                <td><?= e($a['nome']) ?></td>
                <td><?= e($a['nacionalidade'] ?? '—') ?></td>
                <td>
                    <a href="<?= url('autor/editar/'.$a['id']) ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                    <a href="<?= url('autor/deletar/'.$a['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remover?')">🗑</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
