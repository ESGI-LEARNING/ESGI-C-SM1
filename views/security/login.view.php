<?php
use App\Form\Auth\RegisterType;
$form = new RegisterType();
$config = $form->getConfig();
?>
<section>
	<fieldset>
		<legend><h2>Se connecter</h2></legend>
		<!--//Insérer le formulaire d'inscription-->
		<form method="<?= $config["config"]["method"] ?>"
		      action="<?= $config["config"]["action"] ?>"
		      class="<?= $config["config"]["class"] ?>">

            <?php foreach ($config["inputs"] as $name => $configInput): ?>
				<label for="<?php echo $name ?>"><?php echo $name ?></label>
				<input
						name="<?= $name ?>"
						placeholder="<?= $configInput["placeholder"] ?>"
						class="<?= $configInput["class"] ?>"
						id="<?= $configInput["placeholder"] ?>"
						type="<?= $configInput["type"] ?>"
                    <?= $configInput["required"] ? "required" : "" ?>
				><br>
            <?php endforeach; ?>
			<input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
            <?php if (!empty($data["error"])): ?>
				<p class="error"><?= $data["error"] ?></p>
            <?php endif; ?>
		</form>
	</fieldset>
</section>
