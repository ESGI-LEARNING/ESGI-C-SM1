<div class="card-carousel">
<div class="carousel-container">
    <div class="carousel">
        <?php foreach ($article->images as $image) { ?>
            <div class="carousel-item">
                <img src="<?= $image->image(600, 400); ?>" alt="<?= $article->getName(); ?>">
            </div>
        <?php } ?>
    </div>
    <button id="prevBtn" class="carousel-btn prev">&#10094;</button>
    <button id="nextBtn" class="carousel-btn next">&#10095;</button>
</div>

    <div class="card-photo-info">
        <h2 class="card-photo-title"><?= $article->getName(); ?></h2>
        <p class="article-description">Description: <?= $article->getDescription(); ?></p>
        <p class="card-photo-author">Créateur: <?= $article->user->getUsername(); ?></p>
    </div>
</div>

<?php include 'comment/index.view.php'; ?>
