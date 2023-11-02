<?php
$manifest = json_decode(file_get_contents('./build/manifest.json'), true);
$css = $manifest['assets/js/app.css']['file'];
$js = $manifest['assets/js/app.js']['file'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Template Front</title>
	<script type="module" src="http://localhost:5173/assets/main.js"></script>
	<script type="module" src="http://localhost:5173/@vite/client"></script>
	<link rel="stylesheet" href="./build/<?php echo $css ?>" type="text/css">
	<script src="./build/<?php echo $js ?>"></script>
</head>
<body>
<header>
	<nav>
		<ul>
			<li><a href="/">accueil</a></li>
			<li><a href="/gallery">portfolio</a></li>
		</ul>
	</nav>
	<h1>Henri Cartier-Bresson</h1>
	<nav>
		<ul>
			<li><a href="/contact">contact</a></li>
			<li><a href="/a-propos">a-propos</a></li>
		</ul>
	</nav>
</header>
<main>
	<h1>Template Front</h1>
    <?php include $this->viewName; ?>
</main>
<footer id="footer">
	<div class="caté">
		<section>
			<h2>Catégorie</h2>
			<ul>
				<li><a href="#">Portrait</a></li>
				<li><a href="#">Paysage</a></li>
				<li><a href="#">Nature</a></li>
				<li><a href="#">Ville</a></li>
			</ul>
		</section>
		<section>
			<h2>Matériel</h2>
			<ul>
				<li><a href="#">Appareil photo</a></li>
				<li><a href="#">Objectif</a></li>
				<li><a href="#">Trépied</a></li>
			</ul>
		</section>
		<section>
			<h2>Contact</h2>
			<ul>
				<li><a href="#">Mail</a></li>
				<li><a href="#">Facebook</a></li>
				<li><a href="#">Twitter</a></li>
				<li><a href="#">Assistance</a></li>
			</ul>
		</section>
	</div>
	<p>&copy; - Tous droits réservés - 2023</p>
</footer>
</body>g
</html>