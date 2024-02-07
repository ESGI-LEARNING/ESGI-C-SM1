<?php if ($images): ?>
    <div class="gallery-container">
        <?= $this->component('gallery', $config = $images); ?>
    </div>
<?php endif; ?>

<div class="article">
    <?php if ($article->image): ?>
        <img src="<?= $articleImage ?>" alt="<?= $article->name ?>" class="article-image">
    <?php endif; ?>

    <h2 class="article-title"><?= $article->name ?></h2>
    <p class="article-description">Description: <?= $article->description ?></p>
    <?php if ($article->username): ?>
        <p class="article-creator">Créateur: <?= $article->username ?></p>
    <?php endif; ?>
</div>
