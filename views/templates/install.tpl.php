<!DOCTYPE html>
<html class="" lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Installation</title>
	<meta name="description" content="Installation">
    <?= assetLoader(); ?>
</head>
<body>
<main class="main-admin">
    <?= $this->component('flash', $this->flash() ?? []); ?> 
    <?php include $this->viewName; ?>
</main>
</body>
</html>