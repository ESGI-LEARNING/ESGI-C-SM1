<div>
    <h1>Users</h1>
    <a href="/admin/users/create">
        Créer un utilisateurs
    </a>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->getId() ?></td>
                    <td><?= $user->getUsername() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td>
                        #
                    </td>
                    <td>
                        <a href="/admin/users/edit/<?= $user->getId() ?>">
                            Modifier
                        </a>
                        <form method="POST" action="/admin/users/delete/<?= $user->getId() ?>" onsubmit="return confirm('Etes vous vraiment sur ?')">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
