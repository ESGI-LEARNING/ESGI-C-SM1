<?php if (!$this->isAuthor()) { ?>
	<section class="profile">
		<form id="form__avatar" class="profil-header__avatar" enctype="multipart/form-data" method="post">
            <?php if ($user->getAvatar() !== null) { ?>
				<div id="wrapper__avatar_img">
					<img class="profile-image" src="<?= $user->getAvatar(); ?>" alt="Profile Image">
				</div>
            <?php } else { ?>
				<div id="wrapper__avatar_img" class="icon-profile ">
                    <?= icon('camera'); ?>
				</div>
            <?php } ?>
			<input type="file" name="avatar" id="avatar" class="input-form">
		</form>
		<div class="profile-info">
			<h2 class="profile-name"><?= $user->getUsername(); ?></h2>
			<p class="profile-title">Email: <?= $user->getEmail(); ?></p>
		</div>
	</section>
<?php } ?>
<?php if ($this->isAuthor()) { ?>
	<section class="profile">
		<form id="form__avatar" class="profil-header__avatar" enctype="multipart/form-data" method="post">
            <?php if ($user->getAvatar() !== null) { ?>
				<div id="wrapper__avatar_img">
					<img class="profile-image" src="<?= $user->getAvatar(); ?>" alt="Profile Image">
				</div>
            <?php } else { ?>
				<div id="wrapper__avatar_img" class="icon-profile ">
                    <?= icon('camera'); ?>
				</div>
            <?php } ?>
			<input type="file" name="avatar" id="avatar" class="input-form">
		</form>

		<div class="profile-info">
			<h2 id="artist-name" class="profile-name"><?= $user->getUsername(); ?></h2>
			<p class="profile-title">Photographe</p>
		</div>
	</section>
<?php } ?>
<section class="profile-modif">
	<ul class="tabs">
		<li class="tab" data-tab="profile">Profil <?= icon('user-round') ?></li>
        <?php if ($this->isAuthor()) { ?>
			<li class="tab" data-tab="photographe">Information photographe <?= icon('camera') ?></li>
        <?php } ?>
	</ul>
	<div class="tab-content" id="profile">
        <?= $this->component('form', $formProfile); ?>
	</div>
	<div class="tab-content" id="photographe">
        <?= $this->component('form', $formAuthor); ?>
	</div>
</section>



<section>
	<a class="button button-lg button-blue" href="/forgot-password">changer le password</a>
	<form method="POST" action="/profil/soft-delete/<?= \Core\Auth\Auth::id() ?>"
	      onsubmit="return confirm('Etes vous vraiment sur ?')">
		<button class="button button-red button-lg" type="submit">Supprimer le compte</button>
		<input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
	</form>
	<form method="POST" action="/profil/hard-delete/<?= \Core\Auth\Auth::id() ?>"
	      onsubmit="return confirm('Etes vous vraiment sur ?')">
		<button class="button button-red button-lg" type="submit">Supprimer le compte définitivement</button>
		<input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
	</form>
</section>
