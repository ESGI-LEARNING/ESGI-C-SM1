<div class="admin-container">
    <section class="table-view-container">
        <div class="table-view-header">
            <h2>Commentaires</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Contenu</th>
                    <th>Signalé</th>
                    <th>Utilisateur</th>
                    <th>Créé le</th>
                    <th>Modifié le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment) { ?>
                    <tr>
                        <td><?= $comment->getId(); ?></td>
                        <td><?= $comment->getContent(); ?></td>
                        <td>
                            <p class="<?= $comment->getIsReported() ? 'pill pill-danger' : 'pill pill-success'; ?>">
                                <?= $comment->getIsReported() ? 'Oui' : 'Non'; ?>
                            </p>
                        </td>
                        <td><?= $comment->user->getUsername(); ?></td>
                        <td><?= $comment->getCreatedAt(); ?></td>
                        <td><?= $comment->getUpdatedAt(); ?></td>
                        <td class="tableau-action">
                            <form method="POST" action="/admin/comments/delete/<?= $comment->getId(); ?>" onsubmit="return confirm('Êtes-vous sûr(e) de supprimer ce commentaire ?')">
                                <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                                <button class="button button-red button-sm" type="submit"><?= icon('trash'); ?></button>
                            </form>
                            <?php if ($comment->getIsReported()) { ?>
                                <form method="POST" action="/admin/comments/keep/<?= $comment->getId(); ?>" onsubmit="return confirm('Êtes-vous sûr(e) de garder ce commentaire ?')">
                                    <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                                    <button class="button button-red button-sm" type="submit"><?= icon('flag'); ?></button>
                                </form>
                            <?php } else { ?>
                                <form method="POST" action="/admin/comments/report/<?= $comment->getId(); ?>" onsubmit="return confirm('Êtes-vous sûr(e) de signaler ce commentaire ?')">
                                    <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                                    <button class="button button-green button-sm" type="submit"><?= icon('flag'); ?></button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
   
        <div class="pagination">
            <?= $this->component('pagination', $comments->links()); ?>
        </div>
    </section>
</div>
