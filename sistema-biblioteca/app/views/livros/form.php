<div class="card" style="max-width:700px; margin:0 auto;">
    <div class="card-header">
        <h2><?= e($titulo) ?></h2>
        <a href="<?= url('livro/index') ?>" class="btn btn-secondary btn-sm">← Voltar</a>
    </div>
    <form method="POST" action="<?= url('livro/salvar') ?>" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
                <label>Título *</label>
                <input type="text" name="titulo" class="form-control" required
                       value="<?= e($livro['titulo'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" name="isbn" class="form-control"
                       value="<?= e($livro['isbn'] ?? '') ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Ano de Publicação</label>
                <input type="number" name="ano" class="form-control" min="1000" max="2099"
                       value="<?= e($livro['ano'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Quantidade Total *</label>
                <input type="number" name="qtd_total" class="form-control" min="1" required
                       value="<?= e($livro['qtd_total'] ?? '1') ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Sinopse</label>
            <textarea name="sinopse" class="form-control" rows="3"><?= e($livro['sinopse'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label>Imagem da Capa</label>
            <input type="file" name="capa" class="form-control" accept="image/*">
        </div>
        <div style="display:flex; gap:.75rem; margin-top:1.2rem;">
            <button type="submit" class="btn btn-success">💾 Salvar</button>
            <a href="<?= url('livro/index') ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
