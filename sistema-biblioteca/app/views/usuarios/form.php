<div class="card" style="max-width:560px;margin:0 auto;">
    <div class="card-header">
        <h2><?= e($titulo) ?></h2>
        <a href="<?= url('usuario/index') ?>" class="btn btn-secondary btn-sm">← Voltar</a>
    </div>

    <?php if (!empty($erros)): ?>
        <ul class="erros-lista">
            <?php foreach ($erros as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php $editando = $usuario && isset($usuario['id']); ?>
    <form method="POST" action="<?= url($editando ? 'usuario/atualizar' : 'usuario/salvar') ?>">
        <?php if ($editando): ?>
            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
        <?php endif; ?>

        <div class="form-group">
            <label>Nome <span style="color:#dc2626">*</span></label>
            <input type="text" name="nome" class="form-control" required
                   value="<?= e($usuario['nome'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>E-mail <span style="color:#dc2626">*</span></label>
            <input type="email" name="email" class="form-control" required
                   value="<?= e($usuario['email'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Perfil <span style="color:#dc2626">*</span></label>
            <select name="perfil" class="form-control" required>
                <option value="leitor"  <?= ($usuario['perfil']??'leitor')==='leitor'?'selected':'' ?>>Leitor</option>
                <option value="admin"   <?= ($usuario['perfil']??'')==='admin'?'selected':'' ?>>Administrador</option>
            </select>
        </div>

        <?php if (!$editando): ?>
        <div class="form-row">
            <div class="form-group">
                <label>Senha <span style="color:#dc2626">*</span></label>
                <input type="password" name="senha" class="form-control" required minlength="6">
                <span class="form-hint">Mínimo 6 caracteres</span>
            </div>
            <div class="form-group">
                <label>Confirmar Senha <span style="color:#dc2626">*</span></label>
                <input type="password" name="confirmar_senha" class="form-control" required>
            </div>
        </div>
        <?php else: ?>
        <hr style="margin:1rem 0;border-color:#e5e7eb">
        <p style="font-size:.85rem;color:#6b7280;margin-bottom:.75rem;">
            Deixe em branco para manter a senha atual:
        </p>
        <div class="form-row">
            <div class="form-group">
                <label>Nova Senha</label>
                <input type="password" name="nova_senha" class="form-control" minlength="6">
            </div>
            <div class="form-group">
                <label>Confirmar Nova Senha</label>
                <input type="password" name="confirmar_nova_senha" class="form-control">
            </div>
        </div>
        <?php endif; ?>

        <div style="display:flex;gap:.75rem;margin-top:1.2rem;">
            <button type="submit" class="btn btn-success">💾 Salvar</button>
            <a href="<?= url('usuario/index') ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
