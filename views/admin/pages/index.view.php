<section class="table-view-container">
	<div class="table-view-header">
		<h2>Page</h2>
		<a class="button button-white button-md" href="/admin/pages/create">
			Créer une page
		</a>
	</div>
	<table>
		<thead>
		<tr>
			<th>id</th>
			<th>title</th>
			<th>metadescription</th>
			<th>slug</th>
			<th>is_hidden</th>
			<th>action</th>
		</tr>
		</thead>
		<tbody>
        <?php foreach ($pages as $page) { ?>
			<tr>
				<td><?= $page->getId(); ?></td>
				<td><?= $page->getTitle(); ?></td>
				<td><?= $page->getMetaDescription(); ?></td>
				<td><?= $page->getSlug(); ?></td>
				<td>
					<form class="hiddenForm" action="/admin/pages/hidden/<?= $page->getId(); ?>" method="post">
						<label class="switch">
							<input class="hiddenCheckbox" type="checkbox" <?= $page->getIsHidden() == 1 ? 'checked' : ''; ?>>
							<span class="slider"></span>
						</label>
					</form>
				</td>
				<td class="tableau-action">
					<a class="button button-blue button-sm" href="/admin/pages/edit/<?= $page->getId(); ?>">
                        <?= icon('square-pen'); ?>
					</a>
					<form method="POST" action="/admin/pages/delete/<?= $page->getId(); ?>"
					      onsubmit="return confirm('Etes vous vraiment sur ?')">
						<button class="button button-red button-sm" type="submit"><?= icon('x'); ?></button>
					</form>
				</td>
			</tr>
        <?php } ?>
		</tbody>
	</table>
</section>

