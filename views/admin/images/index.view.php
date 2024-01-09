<div>
	<h1>Users</h1>
	<a href="/admin/images/create">
		Ajouter une image
	</a>
	<table>
		<thead>
		<tr>
			<th>Id</th>
			<th>name</th>
			<th>slug</th>
			<th>description</th>
			<th>image</th>
			<th>user_id</th>
			<th>isDeleted</th>
			<th>created_at</th>
			<th>updated_at</th>
			<th>Actions</th>
		</tr>
		<tbody>
        <?php foreach ($images as $image) { ?>
			<tr>
				<td><?php echo $image->getId(); ?></td>
				<td><?php echo $image->getName(); ?></td>
				<td><?php echo $image->getSlug(); ?></td>
				<td><?php echo $image->getDescription(); ?></td>
				<td><?php echo $image->getImage(); ?></td>
				<td><?php echo $image->getUserId(); ?></td>
				<td><?php echo $image->getIsDeleted(); ?></td>
				<td><?php echo $image->getCreatedAt(); ?></td>
				<td><?php echo $image->getUpdatedAt(); ?></td>
				<td>
					<a class="button button-blue" href="/admin/images/edit/<?php echo $image->getId(); ?>">
						Modifier
					</a>
					<form method="POST" action="/admin/users/delete/<?php echo $image->getId(); ?>"
					      onsubmit="return confirm('Etes-vous vraiment sûr ?')">
						<button class="button button-red" type="submit">Supprimer</button>
					</form>
				</td>
			</tr>
        <?php } ?>
		</tbody>
	</table>
</div>
