<section class="table-view-container">
	<div class="table-view-header">
		<h2>Articles</h2>
		<a class="button button-white button-md" href="/admin/articles/create">
			Créer un article
		</a>
	</div>
	<table>
		<thead>
		<tr>
			<th>id</th>
			<th>Nom</th>
			<th>Slug</th>
			<th>Description</th>
			<th>Supprimé</th>
			<th>Créé le</th>
			<th>Modifié le</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
        <?php foreach ($articles as $article) { ?>
			<tr>
				<td><?= $article->getId(); ?></td>
				<td><?= $article->getName(); ?></td>
				<td><?= $article->getSlug(); ?></td>
				<td><?= $article->getDescription(); ?></td>
				<td><?= $article->getIsDeleted(); ?></td>
				<td><?= $article->getCreatedAt(); ?></td>
				<td><?= $article->getUpdatedAt(); ?></td>
				<td class="tableau-action">
					<a class="button button-blue button-sm" href="/admin/articles/edit/<?= $article->getId(); ?>">
                        <?= icon('square-pen'); ?>
					</a>
					<form method="POST" action="/admin/articles/delete/<?= $article->getId(); ?>"
					      onsubmit="return confirm('Etes vous vraiment sur ?')">
						<button class="button button-red button-sm" type="submit"><?= icon('x'); ?></button>
					</form>
				</td>
			</tr>
        <?php } ?>
		</tbody>
	</table>
</section>
