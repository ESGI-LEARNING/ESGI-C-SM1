<section>
	<legend><h2>Modifier L'utilisateur <?= $page->name; ?></h2></legend>
    <?= $this->component('form', $form); ?>
	<script>
		tinymce.init({
			selector: '#mytextarea'
		});
	</script>
</section>
