<div class="gallery gallery-container">
    <?php foreach ($config as $image) { ?>
        <article>
            <a href="/article/<?= $image->slug; ?>" class="gallery-item">
	            <img src="<?= $image->image[0]->image(300, 400); ?>" alt="<?= $image->name; ?>">
            </a>
        </article>
    <?php } ?>
</div>
