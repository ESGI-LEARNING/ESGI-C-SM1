<div class="gallery gallery-container">
    <?php foreach ($config as $image) : ?>
        <article>
            <a href="/article/<?= $image->slug ;?>">
                <img src="/images/<?= $image->images; ?>" alt="<?= $image->name; ?>">
            </a>
        </article>
        </div>
    <?php endforeach; ?>
</div>
