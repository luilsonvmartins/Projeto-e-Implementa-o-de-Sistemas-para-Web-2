<div class="card" style="max-width:560px;margin:0 auto;">
    <div class="card-header">
        <h2>👤 Meu Perfil</h2>
    </div>

    <table style="font-size:.95rem;margin-bottom:1.5rem;">
        <tr><td style="font-weight:600;width:130px;padding:.4rem 0;">Nome</td><td><?= e($usuario['nome']) ?></td></tr>
        <tr><td style="font-weight:600;padding:.4rem 0;">E-mail</td><td><?= e($usuario['email']) ?></td></tr>
        <tr><td style="font-weight:600;padding:.4rem 0;">Perfil</td>
            <td><span class="badge <?= $usuario['perfil']==='admin'?'badge-warning':'badge-success' ?>"><?= $usuario['perfil'] ?></span></td></tr>
        <tr><td style="font-weight:600;padding:.4rem 0;">Membro desde</td><td><?= date('d/m/Y', strtotime($usuario['criado_em'])) ?></td></tr>
    </table>

    <hr style="border-color:#e5e7eb;margin-bottom:1.2rem;">
    <h3 style="font-size:1rem;color:#1A3A5C;margin-bottom:1rem;">🔒 Alterar Senha</h3>

    <form method="POST" action="<?= url('usuario/alterarSenha') ?>">
        <div class="form-group">
            <label>Senha Atual <span style="color:#dc2626">*</span></label>
            <input type="password" name="senha_atual" class="form-control" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Nova Senha <span style="color:#dc2626">*</span></label>
                <input type="password" name="nova_senha" class="form-control" required minlength="6">
                <span class="form-hint">Mínimo 6 caracteres</span>
            </div>
            <div class="form-group">
                <label>Confirmar Nova Senha <span style="color:#dc2626">*</span></label>
                <input type="password" name="confirmar_nova_senha" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="width:auto">🔒 Alterar Senha</button>
    </form>
</div>
