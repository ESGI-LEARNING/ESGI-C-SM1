<?php if ($config['type'] !== null) : ?>
    <?php foreach ($config['type']['messages'] as $message) : ?>
        <div class='alert alert-success'><?= $message ?></div>
    <?php endforeach; ?>
<?php endif; ?>
