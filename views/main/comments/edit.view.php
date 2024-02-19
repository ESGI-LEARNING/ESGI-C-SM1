<section>
    <h2>Modifier le commentaire</h2>
    <form class="form" action="/articles/edit-comment/<?= $comment->getId(); ?>" method="post">
        <?= $this->component('form', $form); ?>
        <input type="submit" value="Enregistrer les modifications">
    </form>
</section>
