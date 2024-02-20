<div class="card-photo">
    <?php foreach ($article->images as $image): ?>
        <img src="<?= $image->image(400, 300); ?>" alt="<?= $article->getName(); ?>">
    <?php endforeach; ?>

    <div class="card-photo-info">
        <h2 class="card-photo-title"><?= $article->getName(); ?></h2>
        <p class="article-description">Description: <?= $article->getDescription(); ?></p>
        <p class="card-photo-author">Créateur: <?= $article->user->getUsername(); ?></p>
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

<div class="comments">
    <h3>Commentaires</h3>
    <?php if (empty($article->comments)) { ?>
        <p>Aucun commentaire pour le moment</p>
    <?php } else { ?>
        <?php foreach ($article->comments as $comment) { ?>
            <div class="comment">
                <div class="column">
                    <p><?= $comment->getContent(); ?></p>
                    <p>Posté par <?= $comment->user->getUsername(); ?> le <?= $comment->getCreatedAt(); ?></p>
                </div>
                <div class="column">
                    <div class="formActions">
                    <form class="__report-form" method="POST" action="/articles/report-comment/<?= $comment->getId(); ?>" onsubmit="return confirm('Êtes-vous sûr(e) de signaler ce commentaire ?')">
                        <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                        <button class="button button-green button-sm" type="submit"><?= icon('flag'); ?></button>
                    </form>
                    <form class="__delete-form" method="POST" action="/articles/delete-comment/<?= $comment->getId(); ?>" onsubmit="return confirm('Êtes-vous sûr(e) de supprimer ce commentaire ?')">
                        <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                        <button class="button button-red button-sm" type="submit"><?= icon('trash'); ?></button>
                    </form>
                    <form class="__edit-form" method="POST" action="/articles/edit-comment/<?= $comment->getId(); ?>" onsubmit="return confirm('Êtes-vous sûr(e) de modifier ce commentaire ?')">
                        <button class="button button-blue button-sm" type="submit"><?= icon('square-pen'); ?></button>
                    </form>
                </div>
            </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>

