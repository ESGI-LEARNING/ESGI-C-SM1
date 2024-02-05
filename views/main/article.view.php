<div class="article">
    <h2><?= $article->name ?></h2>
    <p>Description: <?= $article->description ?></p>
    <?php if ($article->username): ?>
        <p>Créateur: <?= $article->username ?></p>
    <?php endif; ?>

    <?php if ($article->image): ?>
        <img src="<?= $articleImage ?>" alt="<?= $article->name ?>">
    <?php endif; ?>
</div>

<?php if ($images): ?>
    <?= $this->component('gallery', $config = $images); ?>
<?php endif; ?>