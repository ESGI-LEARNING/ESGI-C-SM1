
<div class="admin-container">
<?= $this->component('sideBarAdmin', $config = []); ?>
<section class="table-view-container">
		<div class="table-view-header">
            <h2>Commentaire</h2>
</div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Content</th>
                <th>Reported</th>
                <th>Deleted</th>
                <th>User</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment) { ?>
                <tr>
                    <td><?= $comment->getId(); ?></td>
                    <td><?= $comment->getContent(); ?></td>
                    <td><?= $comment->isReported() ? 'Yes' : 'No'; ?></td>
                    <td><?= $comment->getIsDeleted() ? 'Yes' : 'No'; ?></td>
                    <td><?= $comment->getUsername(); ?></td>
                    <td><?= $comment->getCreatedAt(); ?></td>
                    <td><?= $comment->getUpdatedAt(); ?></td>
                    <td class="tableau-action">
                        <form method="POST" action="/admin/comments/delete/<?= $comment->getId(); ?>" onsubmit="return confirm('Are you sure?')">
                        <button class="button button-red button-sm" type="submit"><?= icon('x'); ?></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </section>
</div>
