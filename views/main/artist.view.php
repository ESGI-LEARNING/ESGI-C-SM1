<div class="profile">
	<img class="profile-image" src="https://apprendre-la-photo.fr/wp-content/uploads/2021/01/news_31916_0.jpg" alt="Profile Image">
	<div class="profile-info">
		<h2 id="artist-name" class="profile-name">Alex Shuper</h2>
		<p class="profile-title">Photographe</p>
		<p class="profile-location">France, Paris</p>
		<ul class="profile-interests-list">
			<li>Art Numérique</li>
			<li>Rendus 3D</li>
			<li>Fonds D'écran HD</li>
			<li>Photographie</li>
		</ul>
	</div>
</div>
<?= $this->component('gallery', $config = []); ?>
<?= $this->component('modal', $config = []); ?>
<a href="/gallery" id="back-to-gallery" class="back-to-gallery button button-black">Back to Gallery</a>
