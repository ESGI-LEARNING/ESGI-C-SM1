<div class="gallery gallery-container">
    <?php foreach ($config as $image) : ?>
        <article>
            <a href="/article/<?= $image->slug ;?>" class="gallery-item">
                <img src="/images/<?= $image->images; ?>" alt="<?= $image->name; ?>" class="gallery-image">
            </a>
        </article>
    <?php endforeach; ?>
</div>
