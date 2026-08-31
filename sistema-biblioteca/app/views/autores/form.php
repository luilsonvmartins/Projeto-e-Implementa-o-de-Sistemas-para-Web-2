<div class="card" style="max-width:500px;margin:0 auto;">
    <div class="card-header"><h2><?= e($titulo) ?></h2><a href="<?= url('autor/index') ?>" class="btn btn-secondary btn-sm">← Voltar</a></div>
    <?php if (!empty($erros)): ?>
        <ul class="erros-lista"><?php foreach ($erros as $e2): ?><li><?= e($e2) ?></li><?php endforeach; ?></ul>
    <?php endif; ?>
    <form method="POST" action="<?= url($autor && isset($autor['id']) ? 'autor/atualizar' : 'autor/salvar') ?>">
        <?php if ($autor && isset($autor['id'])): ?><input type="hidden" name="id" value="<?= $autor['id'] ?>"><?php endif; ?>
        <div class="form-group">
            <label>Nome <span style="color:#dc2626">*</span></label>
            <input type="text" name="nome" class="form-control" required maxlength="150" value="<?= e($autor['nome'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Nacionalidade</label>
            <input type="text" name="nacionalidade" class="form-control" value="<?= e($autor['nacionalidade'] ?? '') ?>">
        </div>
        <div style="display:flex;gap:.75rem;margin-top:1rem;">
            <button type="submit" class="btn btn-success">💾 Salvar</button>
            <a href="<?= url('autor/index') ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
