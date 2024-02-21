<?php if (\Core\Auth\Auth::check()) { ?>
<form class="form" action="/article/<?= $article->getSlug(); ?>/create-comment" method="post">
    <fieldset>
        <label for="comment">Votre commentaire :</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
        <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
        <input type="submit" value="Envoyer">
    </fieldset>
</form>
<?php } ?>

<div class="comments mt">
    <h3><?= count($comments); ?> Commentaires:</h3>

    <?php foreach ($comments as $comment) { ?>
        <div class="comment mt-2">
            <div class="column">
                <p><?= $comment->getContent(); ?></p>
                <p>Posté par <?= $comment->user->getUsername(); ?> le <?= $comment->getCreatedAt(); ?></p>

                <div class="d-none" id="edit-comment-<?= $comment->getId(); ?>">
                    <form class="form" action="/article/<?= $article->getSlug(); ?>/edit-comment/<?= $comment->getId(); ?>" method="post">
                        <fieldset>
                            <label for="comment">Modifier votre commentaire :</label><br>
                            <textarea id="comment" name="comment" rows="4"
                                      cols="50"><?= $comment->getContent(); ?></textarea><br>
                            <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                            <input type="submit" value="Modifier">
                        </fieldset>
                    </form>
                </div>
            </div>
            <?php if (\Core\Auth\Auth::check() !== false) { ?>
                <div class="column">
                    <div class="formActions gap-2">
                        <?php if (\Core\Auth\Auth::id() !== $comment->getUserId()) { ?>
                            <form class="__report-form" method="POST"
                                action="/article/<?= $article->getSlug(); ?>/report-comment/<?= $comment->getId(); ?>"
                                onsubmit="return confirm('Êtes-vous sûr(e) de signaler ce commentaire ?')">
                                <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                                <button class="button <?= $comment->getIsReported() ? 'button-red' : 'button-green'; ?> button-sm" type="submit"><?= icon('flag'); ?></button>
                            </form>
                        <?php } ?>
                        <?php if (\Core\Auth\Auth::id() === $comment->getUserId()) { ?>
                            <button class="button button-blue button-sm" onClick="toggleCommentInput(<?= $comment->getId(); ?>)" id="button-edit-comment-<?= $comment->getId(); ?>" type="button"><?= icon('square-pen'); ?></button>

                            <form class="__delete-form" method="POST"
                                action="/article/<?= $article->getSlug(); ?>/delete-comment/<?= $comment->getId(); ?>"
                                onsubmit="return confirm('Êtes-vous sûr(e) de supprimer ce commentaire ?')">
                                <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                                <button class="button button-red button-sm" type="submit"><?= icon('trash'); ?></button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>


<script>
    function toggleCommentInput(id) {
        let commentInput = document.querySelector('#edit-comment-' + id);

        commentInput.classList.toggle('d-none');
        commentInput.classList.toggle('d-block');
    }
</script>
