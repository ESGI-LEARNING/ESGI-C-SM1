<section>
	<h2>Menu</h2>
	<hr>
	<header>
		<nav>
			<ul>
				<li><a href="/">Accueil</a></li>
				<li><a href="/gallery">Gallerie</a></li>
			</ul>
		</nav>
		<h1>Henri Cartier-Bresson</h1>
		<nav>
			<ul>
				<li><a href="/contact">Contact</a></li>
				<li><a href="/a-propos">À Propos</a></li>
				<li><a><?= icon('user-round'); ?></a></li>
			</ul>
		</nav>
	</header>
</section>
<section>
	<h2>Footer</h2>
	<hr>
	<footer class="footer-container">
		<div class="mention-legale">
			<ul>
				<li><?= icon('twitter'); ?> </li>
				<li><?= icon('facebook'); ?> </li>
				<li><?= icon('instagram'); ?> </li>
			</ul>
			<p>&copy; - Shutterview - Tous droits réservés | 2023 - <?= date('Y'); ?></p>
			<ul class="legal-links">
				<li><a href="#">Mentions Légales</a></li>
				<li><a href="#">CGU</a></li>
				<li><a href="#">Confidentialité</a></li>
			</ul>
		</div>
	</footer>
</section>
<section>
	<h2>Icon</h2>
	<hr>
    <?= icon(iconName: 'user-round'); ?>
    <?= icon(iconName: 'users'); ?>
	<?= icon(iconName: 'log-in'); ?>
    <?= icon(iconName: 'log-out'); ?>
    <?= icon(iconName: 'menu'); ?>
    <?= icon(iconName: 'x'); ?>
	<?= icon(iconName: 'message-square-text'); ?>
    <?= icon(iconName: 'twitter'); ?>
    <?= icon(iconName: 'facebook'); ?>
    <?= icon(iconName: 'instagram'); ?>
	<?= icon(iconName: 'moon'); ?>
	<?= icon(iconName: 'sun'); ?>
	<?= icon(iconName: 'square-pen'); ?>
	<?= icon(iconName: 'panels-top-left'); ?>
	<?= icon(iconName: 'layout-dashboard'); ?>
	<?= icon(iconName: 'image'); ?>
</section>
<section>
	<h2>Bouton</h2>
	<hr>
	<button class="button">Button Simple</button>
	<button class="button button-black">Bouton noir</button>
	<button class="button button-white">Bouton blanc</button>
	<button class="button button-green">Bouton vert</button>
	<button class="button button-red">Bouton rouge</button>
	<button class="button button-blue">Bouton bleu</button>
	<br>
	<h2>Taille des boutons</h2>
	<hr>
	<button class="button button-lg">Bouton Large</button>
	<button class="button button-md">Bouton Moyen</button>
	<button class="button button-sm">Bouton Petit</button>
</section>
<section>
	<h2>Alerte</h2>
	<hr>
	<p class="alert">Alerte Standard</p>
	<p class="alert alert-error">Alerte Erreur</p>
	<p class="alert alert-success">Alerte Succès</p>
	<p class="alert alert-warning">Alerte Avertissement</p>
	<p class="alert alert-info">Alerte Info</p>
</section>
<section>
	<h2>Formulaire</h2>
	<hr>
	<form>
		<fieldset>
			<legend>Legend</legend>
			<label for="name">Name</label>
			<input type="text" name="name" id="name" placeholder="Name">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" placeholder="Email">
			<label for="date">Date</label>
			<input type="date" name="date" id="date">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="Password">
			<label for="textarea">Textarea</label>
			<textarea name="textarea" id="textarea" cols="30" rows="10"></textarea>
			<label for="select">Select</label>
			<select name="select" id="select">
				<option value="1">Option 1</option>
				<option value="2">Option 2</option>
				<option value="3">Option 3</option>
			</select>
			<label for="file">File</label>
			<input type="file" name="file" id="file">
			<label for="submit">Submit</label>
			<input type="submit" name="submit" value="Submit">
			<label for="reset">Reset</label>
			<input type="reset" value="Reset">
			<label for="checkbox">Switch / Checkbox</label>
			<label class="switch">
				<input type="checkbox">
				<span class="slider"></span>
			</label>
			<label class="switch">
				<input type="checkbox" checked>
				<span class="slider"></span>
			</label>
		</fieldset>
	</form>
</section>
<section>
	<h2>Hiérarchie des Titres</h2>
	<hr>
	<h1>H1 - Lorem Ipsum</h1>
	<h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h1>
	<h2>H2 - Lorem Ipsum</h2>
	<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h2>
	<h3>H3 - Lorem Ipsum</h3>
	<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
	<h4>H4 - Lorem Ipsum</h4>
	<H4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </H4>
	<h5>H5 - Lorem Ipsum</h5>
	<H5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </H5>
</section>
<section>
	<h2>Tableau</h2>
	<hr>
	<table>
		<thead>
		<tr>
			<th>Colonne 1</th>
			<th>Colonne 2</th>
			<th>Colonne 3</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Ligne 1</td>
			<td>Ligne 1</td>
			<td>Ligne 1</td>
		</tr>
		<tr>
			<td>Ligne 2</td>
			<td>Ligne 2</td>
			<td>Ligne 2</td>
		</tr>
		<tr>
			<td>Ligne 3</td>
			<td>Ligne 3</td>
			<td>Ligne 3</td>
		</tr>
		</tbody>
	</table>
</section>
<section>
	<h2>Gallery</h2>
	<hr>
	<div class="gallery-container">
        <?php for ($i = 0; $i < 4; ++$i) { ?>
			<img src="https://images.unsplash.com/photo-1702700630321-4e3a9deb8750?q=80&w=987&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
			     alt="">
        <?php } ?>
	</div>
</section>
<section>
	<h2>Card</h2>
	<hr>
	<ul class="dashboard-list">
		<li class="dashboard-card">
			<h3>Nombre de donnés</h3>
			<p>5</p>
		</li>
	</ul>
</section>
<section>
	<h2>Card Photo</h2>
	<hr>
	<div class="card-photo">
		<img src="https://images.unsplash.com/photo-1702700630321-4e3a9deb8750?q=80&w=987&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
		     alt="">
		<div class="card-photo-info">
			<p class="card-photo-author">Author</p>
			<p class="card-photo-title">Photo Title</p>
		</div>
	</div>
</section>

<section>
	<h2>Modale</h2>
	<hr>
	<div class="modal-content">
		<span class="close" id="close-modal"><?= icon('x'); ?></span>
		<img src="https://apprendre-la-photo.fr/wp-content/uploads/2021/01/news_31916_0.jpg" id="modal-image"
		     alt="Enlarged Image">
		<div id="modal-info">
			<p id="user-name">Username</p>
			<p id="photo-title"></p>
			<label for="comment"></label>
			<textarea id="comment" placeholder="Add a comment"></textarea>
			<button class="button button-blue" id="add-comment">Add Comment</button>
		</div>
	</div>

</section>

<section>
	<h2>Card profile</h2>
	<hr>
	<div class="profile">
		<img class="profile-image" src="https://apprendre-la-photo.fr/wp-content/uploads/2021/01/news_31916_0.jpg"
		     alt="Profile Image">
		<div class="profile-info">
			<h2 class="profile-name">Alex Shuper</h2>
			<p class="profile-title">Digital Artist & Photographer</p>
			<p class="profile-location">Liepaja, Latvia</p>
			<ul class="profile-interests-list">
				<li>Art Numérique</li>
				<li>Rendus 3D</li>
				<li>Fonds D'écran HD</li>
				<li>Photographie</li>
			</ul>
		</div>
	</div>
</section>


