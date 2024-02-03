<section class="table-view-container">
	<div class="table-view-header">
		<h2>Utilisateur</h2>
		<a class="button button-white button-md" href="/admin/users/create">
			Créer un utilisateurs
		</a>
	</div>
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
        <?php foreach ($users as $user) { ?>
			<tr>
				<td><?= $user->getId(); ?></td>
				<td><?= $user->getUsername(); ?></td>
				<td><?= $user->getEmail(); ?></td>
				<td>
					#
				</td>
				<td class="tableau-action">
					<a class="button button-blue button-sm" href="/admin/users/edit/<?= $user->getId(); ?>">
                        <?= icon('square-pen'); ?>
					</a>
					<form method="POST" action="/admin/users/delete/<?= $user->getId(); ?>"
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
