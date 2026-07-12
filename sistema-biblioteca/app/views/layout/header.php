<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo ?? APP_NAME) ?></title>
    <style>
        /* ── Reset & Base ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; color: #333; min-height: 100vh; }
        a { color: #2E6DA4; text-decoration: none; }
        a:hover { text-decoration: underline; }

        /* ── Navbar ── */
        .navbar {
            background: #1A3A5C;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 56px;
            box-shadow: 0 2px 6px rgba(0,0,0,.3);
        }
        .navbar-brand {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: .5px;
        }
        .navbar-nav {
            display: flex;
            gap: 4px;
            list-style: none;
        }
        .navbar-nav a {
            color: #c8ddf0;
            padding: .4rem .9rem;
            border-radius: 4px;
            font-size: .88rem;
            transition: background .2s;
        }
        .navbar-nav a:hover, .navbar-nav a.active {
            background: #2E6DA4;
            color: #fff;
            text-decoration: none;
        }
        .navbar-user {
            color: #c8ddf0;
            font-size: .85rem;
            display: flex;
            align-items: center;
            gap: .8rem;
        }
        .navbar-user a {
            color: #f87171;
            font-size: .82rem;
        }

        /* ── Container ── */
        .container { max-width: 1100px; margin: 0 auto; padding: 1.5rem 1rem; }
        .main-content { padding-top: .5rem; }

        /* ── Alerts ── */
        .alert {
            padding: .75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: .9rem;
        }
        .alert-success { background: #dcfce7; color: #166534; border-left: 4px solid #16a34a; }
        .alert-erro    { background: #fee2e2; color: #991b1b; border-left: 4px solid #dc2626; }

        /* ── Cards ── */
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,.1);
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
        }
        .card-header h2 { font-size: 1.1rem; color: #1A3A5C; }

        /* ── Botões ── */
        .btn {
            display: inline-block;
            padding: .45rem 1.1rem;
            border-radius: 5px;
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: opacity .2s;
        }
        .btn:hover { opacity: .88; text-decoration: none; }
        .btn-primary  { background: #2E6DA4; color: #fff; }
        .btn-success  { background: #16a34a; color: #fff; }
        .btn-danger   { background: #dc2626; color: #fff; }
        .btn-secondary{ background: #6b7280; color: #fff; }
        .btn-sm { padding: .3rem .7rem; font-size: .8rem; }

        /* ── Tabela ── */
        table { width: 100%; border-collapse: collapse; font-size: .9rem; }
        th { background: #1A3A5C; color: #fff; padding: .7rem .9rem; text-align: left; }
        td { padding: .65rem .9rem; border-bottom: 1px solid #e5e7eb; }
        tr:nth-child(even) td { background: #f8fafc; }
        tr:hover td { background: #EBF3FB; }

        /* ── Formulário ── */
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-size: .88rem; font-weight: 600; color: #374151; margin-bottom: .3rem; }
        .form-control {
            width: 100%;
            padding: .5rem .75rem;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: .9rem;
            transition: border-color .2s;
        }
        .form-control:focus { outline: none; border-color: #2E6DA4; box-shadow: 0 0 0 3px rgba(46,109,164,.15); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
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
    <div class="navbar-user">
        👤 <?= e($_SESSION['usuario_nome'] ?? '') ?>
        <a href="<?= url('auth/logout') ?>">Sair</a>
    </div>
    <?php endif; ?>
</nav>
