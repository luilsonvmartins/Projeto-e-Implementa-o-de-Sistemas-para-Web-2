<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>404 — Página não encontrada</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; text-align: center; }
        h1 { font-size: 5rem; color: #1A3A5C; }
        p { color: #6b7280; margin: 1rem 0 2rem; }
        a { background: #2E6DA4; color: #fff; padding: .6rem 1.4rem; border-radius: 5px; text-decoration: none; }
    </style>
</head>
<body>
    <div>
        <h1>404</h1>
        <p>A página que você procura não foi encontrada.</p>
        <a href="<?= url('home/index') ?>">← Voltar ao início</a>
    </div>
</body>
</html>
