<div>
    <h1>Comments</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Content</th>
                <th>Reported</th>
                <th>Deleted</th> 
                <th>User</th>
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
                    <td><?= $comment->getUser()->getUsername(); ?></td>
                    <td>
                        <form method="POST" action="/admin/comments/delete/<?= $comment->getId(); ?>" onsubmit="return confirm('Are you sure?')">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
