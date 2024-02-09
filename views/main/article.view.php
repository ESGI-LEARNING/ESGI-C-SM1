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

    <!-- Section Commentaires -->
    <div class="comment-section">
        <!-- Formulaire pour ajouter un nouveau commentaire -->
        <form action="/add-comment" method="post">
            <label for="comment">Ajouter un commentaire :</label>
            <textarea name="comment" id="comment" rows="4" cols="50"></textarea>
            <input type="submit" value="Poster le commentaire">
        </form>

        <!-- Affichage des commentaires existants -->
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p><?= $comment->getContent() ?></p>
                <p>Posté par <?= $comment->getUser() ?> le <?= $comment->getCreatedAt() ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
