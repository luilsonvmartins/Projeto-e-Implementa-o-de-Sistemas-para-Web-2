<?php require_once APP . '/views/layout/header.php'; ?>

<main class="main-content">
    <div class="container">
        <?php
        // Exibe flash messages
        if ($msg = flash('sucesso')): ?>
            <div class="alert alert-success">✅ <?= e($msg) ?></div>
        <?php endif; ?>
        <?php if ($msg = flash('erro')): ?>
            <div class="alert alert-erro">❌ <?= e($msg) ?></div>
        <?php endif; ?>

        <?php require_once APP . '/views/' . str_replace('.', '/', $content_view) . '.php'; ?>
    </div>
</main>

<?php require_once APP . '/views/layout/footer.php'; ?>
