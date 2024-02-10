<div class="card-photo" >
    <?php if ($article->image[0]) { ?>
        <img src="<?= $article->image[0]->image(400, 300); ?>" alt="<?= $article->name; ?>">
    <?php } ?>
    <div class="card-photo-info">
        <h2 class="card-photo-title"><?= $article->name; ?></h2>
        <p class="article-description">Description: <?= $article->description; ?></p>
        <?php if ($article->username) { ?>
            <p class="card-photo-author">Créateur: <?= $article->username; ?></p>
        <?php } ?>
    </div>
</div>
<form class="form" action="/articles/create/<?= $article->id ?>" method="post">
    <input type="hidden" name="article_id" value="<?= $article->id ?>">
    <fieldset>
        <label for="comment">Votre commentaire :</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Envoyer">
    </fieldset>
</form>

