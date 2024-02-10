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
    <?php if ($article->image[0]) { ?>
        <img src="<?= $article->image[0]->image(400, 300); ?>" alt="<?= $article->name; ?>" class="article-image">
    <?php } ?>

    <h2 class="article-title"><?= $article->name; ?></h2>
    <p class="article-description">Description: <?= $article->description; ?></p>
    <?php if ($article->username) { ?>
        <p class="article-creator">Créateur: <?= $article->username; ?></p>
    <?php } ?>

    <!-- Formulaire de commentaire -->
    <form action="/articles/create/<?= $article->id ?>" method="post">
        <input type="hidden" name="article_id" value="<?= $article->id ?>">
        <label for="comment">Votre commentaire :</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Envoyer">
    </form>
</div>
