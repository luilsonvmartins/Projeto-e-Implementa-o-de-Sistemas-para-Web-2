<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo ?? APP_NAME) ?></title>
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Segoe UI',sans-serif;background:#f0f2f5;color:#333;min-height:100vh}
        a{color:#2E6DA4;text-decoration:none}a:hover{text-decoration:underline}
        .navbar{background:#1A3A5C;padding:0 1.5rem;display:flex;align-items:center;justify-content:space-between;height:56px;box-shadow:0 2px 6px rgba(0,0,0,.3)}
        .navbar-brand{color:#fff;font-size:1.1rem;font-weight:700}
        .navbar-nav{display:flex;gap:4px;list-style:none}
        .navbar-nav a{color:#c8ddf0;padding:.4rem .9rem;border-radius:4px;font-size:.88rem;transition:background .2s}
        .navbar-nav a:hover{background:#2E6DA4;color:#fff;text-decoration:none}
        .navbar-user{color:#c8ddf0;font-size:.85rem;display:flex;align-items:center;gap:.8rem}
        .navbar-user a{color:#f87171;font-size:.82rem}
        .container{max-width:1100px;margin:0 auto;padding:1.5rem 1rem}
        /* Alerts */
        .alert{padding:.8rem 1rem;border-radius:6px;margin-bottom:1rem;font-size:.9rem;display:flex;align-items:flex-start;gap:.5rem}
        .alert-success{background:#dcfce7;color:#166534;border-left:4px solid #16a34a}
        .alert-erro{background:#fee2e2;color:#991b1b;border-left:4px solid #dc2626}
        .alert-warning{background:#fef9c3;color:#854d0e;border-left:4px solid #ca8a04}
        /* Erros de validação */
        .erros-lista{background:#fee2e2;border-left:4px solid #dc2626;border-radius:6px;padding:.8rem 1rem 0.8rem 1.5rem;margin-bottom:1rem;font-size:.88rem;color:#991b1b}
        .erros-lista li{margin-bottom:.2rem}
        /* Card */
        .card{background:#fff;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,.1);padding:1.5rem;margin-bottom:1rem}
        .card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.2rem}
        .card-header h2{font-size:1.1rem;color:#1A3A5C}
        /* Botões */
        .btn{display:inline-block;padding:.45rem 1.1rem;border-radius:5px;font-size:.88rem;font-weight:600;cursor:pointer;border:none;transition:opacity .2s}
        .btn:hover{opacity:.85;text-decoration:none}
        .btn-primary{background:#2E6DA4;color:#fff}.btn-success{background:#16a34a;color:#fff}
        .btn-danger{background:#dc2626;color:#fff}.btn-secondary{background:#6b7280;color:#fff}
        .btn-warning{background:#d97706;color:#fff}.btn-sm{padding:.3rem .7rem;font-size:.8rem}
        /* Tabela */
        table{width:100%;border-collapse:collapse;font-size:.9rem}
        th{background:#1A3A5C;color:#fff;padding:.7rem .9rem;text-align:left}
        td{padding:.65rem .9rem;border-bottom:1px solid #e5e7eb;vertical-align:middle}
        tr:nth-child(even) td{background:#f8fafc}tr:hover td{background:#EBF3FB}
        /* Formulário */
        .form-group{margin-bottom:1rem}
        .form-group label{display:block;font-size:.88rem;font-weight:600;color:#374151;margin-bottom:.3rem}
        .form-control{width:100%;padding:.5rem .75rem;border:1px solid #d1d5db;border-radius:5px;font-size:.9rem;transition:border-color .2s}
        .form-control:focus{outline:none;border-color:#2E6DA4;box-shadow:0 0 0 3px rgba(46,109,164,.15)}
        .form-control.erro{border-color:#dc2626}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
        .form-hint{font-size:.78rem;color:#9ca3af;margin-top:.25rem}
        /* Badge */
        .badge{display:inline-block;padding:.2rem .6rem;border-radius:12px;font-size:.75rem;font-weight:600}
        .badge-success{background:#dcfce7;color:#166534}.badge-danger{background:#fee2e2;color:#991b1b}
        .badge-warning{background:#fef9c3;color:#854d0e}
        /* Capa */
        .capa-thumb{width:48px;height:64px;object-fit:cover;border-radius:3px;box-shadow:0 1px 3px rgba(0,0,0,.2)}
        .capa-placeholder{width:48px;height:64px;background:#e5e7eb;border-radius:3px;display:flex;align-items:center;justify-content:center;font-size:1.2rem}
        /* Modal confirm */
        .modal-bg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:100;align-items:center;justify-content:center}
        .modal-bg.ativo{display:flex}
        .modal{background:#fff;border-radius:10px;padding:2rem;max-width:400px;width:90%;text-align:center;box-shadow:0 8px 32px rgba(0,0,0,.25)}
        .modal h3{color:#1A3A5C;margin-bottom:.5rem}.modal p{color:#6b7280;margin-bottom:1.5rem;font-size:.9rem}
        .modal-btns{display:flex;gap:.75rem;justify-content:center}
    </style>
</head>
<body>
<nav class="navbar">
    <span class="navbar-brand">📚 <?= APP_NAME ?></span>
    <?php if (isLoggedIn()): ?>
    <ul class="navbar-nav">
        <li><a href="<?= url('home/index') ?>">Início</a></li>
        <li><a href="<?= url('livro/index') ?>">Acervo</a></li>
        <li><a href="<?= url('autor/index') ?>">Autores</a></li>
        <li><a href="<?= url('categoria/index') ?>">Categorias</a></li>
    </ul>
    <div class="navbar-user">👤 <?= e($_SESSION['usuario_nome'] ?? '') ?> <a href="<?= url('auth/logout') ?>">Sair</a></div>
    <?php endif; ?>
</nav>

<!-- Modal de confirmação de exclusão -->
<div class="modal-bg" id="modalExcluir">
    <div class="modal">
        <h3>⚠️ Confirmar exclusão</h3>
        <p id="modalMensagem">Tem certeza que deseja remover este item?<br>Esta ação não pode ser desfeita.</p>
        <div class="modal-btns">
            <form id="formExcluir" method="POST" style="display:inline">
            <button type="submit" class="btn btn-danger">Sim, remover</button>
            </form>
            <button onclick="fecharModal()" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</div>
<script>
function confirmarExclusao(url, nome) {
    document.getElementById('modalMensagem').innerHTML = 'Tem certeza que deseja remover <strong>"' + nome + '"</strong>?<br><small style="color:#9ca3af">Esta ação não pode ser desfeita.</small>';
    document.getElementById('formExcluir').action = url;
    document.getElementById('modalExcluir').classList.add('ativo');
}
function fecharModal() { document.getElementById('modalExcluir').classList.remove('ativo'); }
document.getElementById('modalExcluir').addEventListener('click', function(e){ if(e.target===this) fecharModal(); });
</script>
