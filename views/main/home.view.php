<section>
	<img class="half-height" src="https://apprendre-la-photo.fr/wp-content/uploads/2021/01/news_31916_0.jpg" alt="photo">
</section>
<section class="section-content">
	<?= $this->meta()->content; ?>
</section>
<section>
	<h2>Dernières photos publiées</h2>
	<hr>
	<div class="gallery gallery-container">
        <?php foreach ($lastImages as $lastImage) { ?>
			<article class="card-photo">
				<a href="/article/<?= $lastImage->slug; ?>" class="gallery-item">
					<img src="<?= $lastImage->images[0]->image(200, 400); ?>" alt="<?= $lastImage->images[0]->getImage(); ?>">
				</a>
				<section class="card-photo-content">
					<h3><?= $lastImage->name; ?></h3>
					<p><?= $lastImage->description; ?></p>
				</section>
			</article>
        <?php } ?>
	</div>
</section>
