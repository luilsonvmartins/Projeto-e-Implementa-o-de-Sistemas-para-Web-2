<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?></title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #1A3A5C; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .login-box { background: #fff; border-radius: 10px; padding: 2.5rem 2rem; width: 100%; max-width: 380px; box-shadow: 0 8px 32px rgba(0,0,0,.25); }
        .login-box h1 { text-align: center; color: #1A3A5C; font-size: 1.4rem; margin-bottom: .3rem; }
        .login-box p { text-align: center; color: #6b7280; font-size: .85rem; margin-bottom: 1.8rem; }
        .form-group { margin-bottom: 1.1rem; }
        label { display: block; font-size: .85rem; font-weight: 600; color: #374151; margin-bottom: .3rem; }
        input { width: 100%; padding: .55rem .8rem; border: 1px solid #d1d5db; border-radius: 5px; font-size: .9rem; }
        input:focus { outline: none; border-color: #2E6DA4; box-shadow: 0 0 0 3px rgba(46,109,164,.15); }
        .btn { width: 100%; padding: .7rem; background: #2E6DA4; color: #fff; border: none; border-radius: 5px; font-size: 1rem; font-weight: 700; cursor: pointer; margin-top: .5rem; }
        .btn:hover { background: #1A3A5C; }
        .alert { padding: .6rem .9rem; border-radius: 5px; margin-bottom: 1rem; font-size: .85rem; background: #fee2e2; color: #991b1b; border-left: 4px solid #dc2626; }
    </style>
</head>
<body>
<div class="login-box">
    <h1>📚 <?= APP_NAME ?></h1>
    <p>Faça login para acessar o sistema</p>

    <?php if ($msg = flash('erro')): ?>
        <div class="alert">❌ <?= e($msg) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= url('auth/autenticar') ?>">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required placeholder="admin@biblioteca.com">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn">Entrar</button>
    </form>
</div>
</body>
</html>
