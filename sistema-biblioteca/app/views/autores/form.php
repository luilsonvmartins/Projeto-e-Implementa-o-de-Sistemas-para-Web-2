<div class="card" style="max-width:500px; margin:0 auto;">
    <div class="card-header">
        <h2><?= e($titulo) ?></h2>
        <a href="<?= url('autor/index') ?>" class="btn btn-secondary btn-sm">← Voltar</a>
    </div>
    <form method="POST" action="<?= url('autor/salvar') ?>">
        <div class="form-group">
            <label>Nome *</label>
            <input type="text" name="nome" class="form-control" required value="<?= e($autor['nome'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Nacionalidade</label>
            <input type="text" name="nacionalidade" class="form-control" value="<?= e($autor['nacionalidade'] ?? '') ?>">
        </div>
        <button type="submit" class="btn btn-success">💾 Salvar</button>
        <a href="<?= url('autor/index') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
