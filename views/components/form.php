<form method="<?php echo $config['config']['method']; ?>"
      action="<?php echo $config['config']['action']; ?>"
      class="<?php echo $config['config']['class']; ?>">

    <?php foreach ($config['inputs'] as $name => $configInput) { ?>

        <input
            name="<?php echo $name; ?>"
            type="<?php echo $configInput['type']               ?? 'text'; ?>"
            id="<?php echo $configInput['id']                   ?? ''; ?>"
            class="<?php echo $configInput['class']             ?? ''; ?>"
            placeholder="<?php echo $configInput['placeholder'] ?? ''; ?>"
            value="<?php echo $configInput['value']             ?? ''; ?>"
        ><br>

        <?php if (!empty($configInput['errors'])) { ?>
            <?php foreach ($configInput['errors'] as $fieldErrors) { ?>
                <?php foreach ((array) $fieldErrors as $error) { ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php } ?>
            <?php } ?>
        <?php } ?>

    <?php } ?>
    <input type="submit" name="submit" value="<?php echo $config['config']['submit']; ?>">
</form>
