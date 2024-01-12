<div>
    <h1>Comments</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Content</th>
                <th>Reported</th>
                <th>Deleted</th> 
                <th>User Id</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment) { ?>
                <tr>
                    <td><?php echo $comment->getId(); ?></td>
                    <td><?php echo $comment->getContent(); ?></td>
                    <td><?php echo $comment->isReported() ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $comment->getIsDeleted() ? 'Yes' : 'No'; ?></td> 
                    <td><?php echo $comment->getUserId() ?></td>
                    <td>
                        <form method="POST" action="/admin/comments/delete/<?php echo $comment->getId(); ?>" onsubmit="return confirm('Are you sure?')">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
