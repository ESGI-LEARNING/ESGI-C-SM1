<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Template Front</title>
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/assets/main.js"></script>
</head>
<body>
<header>
	<h1>Header</h1>
	<nav>
		<ul>
			<li><a href="/">accueil</a></li>
			<li><a href="/login">login</a></li>
			<li><a href="/contact">contact</a></li>
			<li><a href="/a-propos">a-propos</a></li>
		</ul>
	</nav>
</header>
<main>
	<h1>Template Front</h1>
    <?php include $this->viewName; ?>
</main>
<footer>
	<p>Tous droits réservés</p>
</footer>
</body>
</html>