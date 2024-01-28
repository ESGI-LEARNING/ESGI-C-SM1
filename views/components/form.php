<form method="<?= $config['config']['method']; ?>"
      action="<?= $config['config']['action']; ?>"
      class="<?= $config['config']['class']; ?>">
	<fieldset>
        <?php foreach ($config['inputs'] as $name => $configInput) { ?>
			<label for="<?= $configInput['name'] ?? ''; ?>"><?= $name; ?></label>

            <?php if (!isset($configInput['input'])) { ?>
				<input
						name="<?= $name; ?>"
						type="<?= $configInput['type']               ?? 'text'; ?>"
						id="<?= $configInput['id']                   ?? ''; ?>"
						class="<?= $configInput['class']             ?? ''; ?>"
						placeholder="<?= $configInput['placeholder'] ?? ''; ?>"
						value="<?= $configInput['value']             ?? ''; ?>"
				><br>
            <?php } ?>

            <?php if (isset($configInput['input']) && $configInput['input'] === \App\Enum\FormTypeEnum::INPUT_TEXTAREA) { ?>
				<textarea
						name="<?= $name; ?>"
						id="<?= $configInput['name']                 ?? ''; ?>"
						class="<?= $configInput['class']             ?? ''; ?>"
						placeholder="<?= $configInput['placeholder'] ?? ''; ?>"
				><?= $configInput['value']                     ?? ''; ?></textarea>
            <?php } ?>
            <?php if (isset($configInput['input']) && $configInput['input'] === \App\Enum\FormTypeEnum::INPUT_SELECT) { ?>
		        <select
						name="<?= $name; ?>"
						id="<?= $configInput['name']     ?? ''; ?>"
						class="<?= $configInput['class'] ?? ''; ?>"
				>
					<option><?= $configInput['placeholder'] ?? ''; ?></option>
                    <?php foreach ($configInput['options'] as $option) { ?>
						<option value="<?= $option->getName(); ?>"><?= $option->getName(); ?></option>
                    <?php } ?>
				</select>
            <?php } ?>

            <?php if (isset($configInput['input']) && $configInput['input'] === \App\Enum\FormTypeEnum::INPUT_SWITCH) { ?>
				<input type="checkbox"
				       name="<?= $name; ?>"
				       id="<?= $configInput['name']                 ?? ''; ?>"
				       class="<?= $configInput['class']             ?? ''; ?>"
				       placeholder="<?= $configInput['placeholder'] ?? ''; ?>"
				       value="<?= $configInput['value']             ?? ''; ?>"
				>
            <?php } ?>

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
	</fieldset>
</form>
