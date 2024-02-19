<?php include 'layout.view.php'; ?>
<section class="profile-action">
	<a class="button button-blue button-lg " href="/forgot-password">changer le password</a>
	<form method="POST" action="/profile/delete"
	      onsubmit="return confirm('Etes vous vraiment sur ?')">
		<button class="button button-red button-lg" type="submit">Supprimer le compte</button>
		<input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
	</form>
	<form method="POST" action="/profile/hard-delete"
	      onsubmit="return confirm('Etes vous vraiment sur ?')">
		<button class="button button-red button-lg" type="submit">Supprimer le compte définitivement</button>
		<input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
	</form>
</section>
