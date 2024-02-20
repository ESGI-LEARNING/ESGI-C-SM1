<div class="gallery gallery-container">
    <?php foreach ($config as $image): ?>
        <article>
            <a href="/article/<?= $image->slug; ?>" class="gallery-item">
                <img src="<?= $image->image; ?>" alt="<?= $image->name; ?>">
            </a>
        </article>
    <?php endforeach; ?>
</div>