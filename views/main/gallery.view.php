<h2>Galerie</h2>
<div class="gallery gallery-container">
    <?php foreach ($pictures as $picture) { ?>
		<article>
			<a href="/article/<?= $picture->slug; ?>" class="gallery-item">
				<img src="<?= $picture->images[0]->image(300, 400); ?>" alt="<?= $picture->images[0]->getImage(); ?>">
			</a>
		</article>
    <?php } ?>
</div>

<div class="pagination">
        <?= $this->component('pagination', $pictures->links()); ?>
</div>