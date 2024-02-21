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
		</tr>
		</thead>
		<tbody>
        <?php foreach ($logs as $log) { ?>
			<tr>
			<td><?= $log->getId(); ?></td>
            <?php if ($log->user == null): ?>
				<td></td>
            <?php else: ?>
				<td><?= $log->user->getUsername(); ?></td>
			<?php endif; ?>
				<td><?= $log->getSubject(); ?></td>
				<td><?= $log->getCreatedAt(); ?></td>
				</tr>
        <?php } ?>
		</tbody>
	</table>

	<div class="pagination">
        <?= $this->component('pagination', $logs->links()); ?>
	</div>
</section>

