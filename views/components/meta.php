<!DOCTYPE html>
<html class="" lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= config('app.name'); ?>
        <?php if ($this->meta() !== null) { ?>
			- <?= $this->meta()->title; ?>
        <?php } ?>
	</title>
    <?php if ($this->meta() !== null) { ?>
		<meta name="description" content="<?= $this->meta()->metadescription; ?>">
    <?php } else { ?>
		<meta name="description" content="<?= config('app.name'); ?>">
    <?php } ?>
    <?= assetLoader(); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" integrity="sha512-VCEWnpOl7PIhbYMcb64pqGZYez41C2uws/M/mDdGPy+vtEJHd9BqbShE4/VNnnZdr7YCPOjd+CBmYca/7WWWCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

