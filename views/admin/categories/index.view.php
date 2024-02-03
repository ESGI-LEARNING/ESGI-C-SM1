<section class="table-view-container">
    <div class="table-view-header">
        <h2>Categories</h2>
        <a class="button button-white button-md" href="/admin/categories/create">
            Créer une categorie
        </a>
    </div>
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Créer le</th>
            <th>Modifier le</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category) { ?>
            <tr>
                <td><?= $category->getId(); ?></td>
                <td><?= $category->getName(); ?></td>
                <td><?= $category->getCreatedAt(); ?></td>
                <td><?= $category->getUpdatedAt(); ?></td>
                <td class="tableau-action">
                    <a class="button button-blue button-sm" href="/admin/categories/edit/<?= $category->getId(); ?>">
                        <?= icon('square-pen'); ?>
                    </a>
                    <form method="POST" action="/admin/categories/delete/<?= $category->getId(); ?>"
                          onsubmit="return confirm('Etes vous vraiment sur ?')">
                        <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                        <button class="button button-red button-sm" type="submit"><?= icon('x'); ?></button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>