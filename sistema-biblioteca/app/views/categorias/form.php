<div class="card" style="max-width:500px; margin:0 auto;">
    <div class="card-header">
        <h2><?= e($titulo) ?></h2>
        <a href="<?= url('categoria/index') ?>" class="btn btn-secondary btn-sm">← Voltar</a>
    </div>
    <form method="POST" action="<?= url('categoria/salvar') ?>">
        <div class="form-group">
            <label>Nome *</label>
            <input type="text" name="nome" class="form-control" required value="<?= e($categoria['nome'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control" rows="3"><?= e($categoria['descricao'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">💾 Salvar</button>
        <a href="<?= url('categoria/index') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
