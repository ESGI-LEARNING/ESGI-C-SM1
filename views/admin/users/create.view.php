<div class="admin-container">
    <?= $this->component('sideBarAdmin', $config = []); ?>
	<section>
			<h2>Créer un utilisateur</h2>
            <?= $this->component('form', $form); ?>
	</section>
</div>