<div class="card" style="max-width:750px;margin:0 auto;">
    <div class="card-header">
        <h2><?= e($titulo) ?></h2>
        <a href="<?= url('livro/index') ?>" class="btn btn-secondary btn-sm">← Voltar</a>
    </div>

    <?php if (!empty($erros)): ?>
    <ul class="erros-lista">
        <?php foreach ($erros as $erro): ?><li><?= e($erro) ?></li><?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <form method="POST" action="<?= url($livro && isset($livro['id']) ? 'livro/atualizar' : 'livro/salvar') ?>" enctype="multipart/form-data">
        <?php if ($livro && isset($livro['id'])): ?>
            <input type="hidden" name="id" value="<?= $livro['id'] ?>">
        <?php endif; ?>

        <div class="form-row">
            <div class="form-group">
                <label>Título <span style="color:#dc2626">*</span></label>
                <input type="text" name="titulo" class="form-control <?= in_array('Título é obrigatório.',$erros??[]) ? 'erro':'' ?>"
                    required maxlength="200" value="<?= e($livro['titulo'] ?? '') ?>">
                <span class="form-hint">Máx. 200 caracteres</span>
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" name="isbn" class="form-control" maxlength="20" value="<?= e($livro['isbn'] ?? '') ?>">
                <span class="form-hint">Ex: 978-85-359-0277-5</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Ano de Publicação</label>
                <input type="number" name="ano" class="form-control" min="1000" max="2099" value="<?= e($livro['ano'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Quantidade Total <span style="color:#dc2626">*</span></label>
                <input type="number" name="qtd_total" class="form-control <?= in_array('Quantidade deve ser no mínimo 1.',$erros??[]) ? 'erro':'' ?>"
                    min="1" required value="<?= e($livro['qtd_total'] ?? '1') ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Categoria</label>
                <select name="id_categoria" class="form-control">
                    <option value="">— Selecione —</option>
                    <?php foreach ($categorias as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= ($livro['id_categoria'] ?? '') == $c['id'] ? 'selected':'' ?>>
                            <?= e($c['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Autores</label>
                <select name="autores[]" class="form-control" multiple style="height:80px">
                    <?php
                    $autoresSelecionados = array_column($livro['autores'] ?? [], 'id');
                    foreach ($autores as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= in_array($a['id'],$autoresSelecionados) ? 'selected':'' ?>>
                            <?= e($a['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="form-hint">Segure Ctrl para selecionar mais de um</span>
            </div>
        </div>
        <div class="form-group">
            <label>Sinopse</label>
            <textarea name="sinopse" class="form-control" rows="3"><?= e($livro['sinopse'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label>Imagem da Capa</label>
            <input type="file" name="capa" class="form-control" accept="image/*">
            <span class="form-hint">JPG, PNG, GIF ou WebP — máx. 2MB</span>
            <?php if (!empty($livro['capa'])): ?>
                <div style="margin-top:.5rem;display:flex;align-items:center;gap:.75rem;">
                    <img src="<?= url('uploads/capas/'.e($livro['capa'])) ?>" style="height:80px;border-radius:4px;">
                    <small style="color:#9ca3af">Capa atual — envie uma nova para substituir</small>
                </div>
            <?php endif; ?>
        </div>
        <div style="display:flex;gap:.75rem;margin-top:1.5rem;">
            <button type="submit" class="btn btn-success">💾 Salvar</button>
            <a href="<?= url('livro/index') ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
