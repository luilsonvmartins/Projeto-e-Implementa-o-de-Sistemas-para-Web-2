<?php require_once APP . '/views/layout/header.php'; ?>
<main><div class="container">
<?php if ($msg = flash('sucesso')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
<?php if ($msg = flash('erro')):    ?><div class="alert alert-erro"><?= e($msg) ?></div><?php endif; ?>
<?php require_once APP . '/views/' . str_replace('.','/',$content_view) . '.php'; ?>
</div></main>
<?php require_once APP . '/views/layout/footer.php'; ?>
