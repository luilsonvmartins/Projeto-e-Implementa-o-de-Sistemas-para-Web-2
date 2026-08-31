<div class="card" style="max-width:500px;margin:0 auto;">
    <div class="card-header"><h2><?= e($titulo) ?></h2><a href="<?= url('categoria/index') ?>" class="btn btn-secondary btn-sm">← Voltar</a></div>
    <?php if (!empty($erros)): ?>
        <ul class="erros-lista"><?php foreach ($erros as $e2): ?><li><?= e($e2) ?></li><?php endforeach; ?></ul>
    <?php endif; ?>
    <form method="POST" action="<?= url($categoria && isset($categoria['id']) ? 'categoria/atualizar' : 'categoria/salvar') ?>">
        <?php if ($categoria && isset($categoria['id'])): ?><input type="hidden" name="id" value="<?= $categoria['id'] ?>"><?php endif; ?>
        <div class="form-group">
            <label>Nome <span style="color:#dc2626">*</span></label>
            <input type="text" name="nome" class="form-control" required value="<?= e($categoria['nome'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control" rows="3"><?= e($categoria['descricao'] ?? '') ?></textarea>
        </div>
        <div style="display:flex;gap:.75rem;margin-top:1rem;">
            <button type="submit" class="btn btn-success">💾 Salvar</button>
            <a href="<?= url('categoria/index') ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
