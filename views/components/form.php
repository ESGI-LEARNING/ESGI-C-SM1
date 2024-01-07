<form method="<?= $config['config']['method']; ?>"
      action="<?= $config['config']['action']; ?>"
      class="<?= $config['config']['class']; ?>">
	<fieldset>
        <?php foreach ($config['inputs'] as $name => $configInput) { ?>
	        <legend><h2><?= $name; ?></h2></legend>
	        <input
					name="<?= $name; ?>"
					type="<?= $configInput['type']               ?? 'text'; ?>"
					id="<?= $configInput['id']                   ?? ''; ?>"
					class="<?= $configInput['class']             ?? ''; ?>"
					placeholder="<?= $configInput['placeholder'] ?? ''; ?>"
					value="<?= $configInput['value']             ?? ''; ?>"
			><br>

            <?php if (!empty($configInput['errors'])) { ?>
                <?php foreach ($configInput['errors'] as $fieldErrors) { ?>
			        <ul class="alert-list alert alert-error">
                        <?php foreach ((array) $fieldErrors as $error) { ?>
					        <li><?= $error; ?></li>
                        <?php } ?>
			        </ul>
                <?php } ?>
            <?php } ?>

    <?php } ?>

    <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">

    <input type="submit" name="submit" value="<?= $config['config']['submit']; ?>">
</form>
