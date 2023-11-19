<?php include "../views/component/meta.view.php"; ?>
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