<section class="table-view-container">
    <div class="table-view-header">
        <h2>Logs</h2>
    </div>
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Utilisateur</th>
            <th>Sujet</th>
            <th>Créer le</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($logs as $log) { ?>
            <tr>
                <td><?= $log->getId(); ?></td>
                <td><?= $log->getId(); ?></td>
                <td><?= $log->getSubject(); ?></td>
                <td><?= $log->getCreatedAt(); ?></td>
                <td class="tableau-action">

                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <div class="pagination">
        <?= $this->component('pagination', $logs->links()); ?>
    </div>
</section>

