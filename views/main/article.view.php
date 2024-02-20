<div class="card-photo">
    <?php foreach ($article->images as $image): ?>
        <img src="<?= $image->image(400, 300); ?>" alt="<?= $article->getName(); ?>">
    <?php endforeach; ?>

    <div class="card-photo-info">
        <h2 class="card-photo-title"><?= $article->getName(); ?></h2>
        <p class="article-description">Description: <?= $article->getDescription(); ?></p>
        <p class="card-photo-author">Créateur: <?= $article->user->getUsername(); ?></p>
    </div>
</div>

<?php include 'comment/index.view.php'; ?>

