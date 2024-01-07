<div class="admin-container">

	<?= $this->component('sideBarAdmin', $config = []); ?>

	<section>
	    <fieldset>
	        <legend><h2>Modifier L'utilisateur <?= $user->getUsername(); ?></h2></legend>
	        <?= $this->component('form', $form); ?>
	    </fieldset>
	</section>
</div>