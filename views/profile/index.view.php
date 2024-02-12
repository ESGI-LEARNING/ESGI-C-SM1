<?php if (!$this->hasRole(\Core\Enum\Role::ROLE_AUTHOR)) { ?>
	<section class="profile">
		<form id="form__avatar" class="profil-header__avatar" enctype="multipart/form-data" method="post">
            <?php if ($user->avatar !== null) { ?>
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
			<h2 class="profile-name"><?= $user->username; ?></h2>
			<p class="profile-title">Email: <?= $user->email; ?></p>
		</div>
	</section>
<?php } ?>
<?php if ($this->hasRole(\Core\Enum\Role::ROLE_AUTHOR)) { ?>
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
			<h2 id="artist-name" class="profile-name"><?= $user->username; ?></h2>
			<p class="profile-title">Photographe</p>
			<div class="profile-sub-info">
				<p class="profile-info"><?= icon('user-round'); ?> <?= $author->getFirstName(); ?> <?= $author->getLastName(); ?></p>
			</div>
			<div class="profile-sub-info">
				<p class="profile-info"><?= icon('mail'); ?> <?= $user->getEmail(); ?></p>
				<p class="profile-info"><?= icon('building'); ?> <?= $author->getCity(); ?></p>
				<p class="profile-info"><?= icon('land-plot'); ?><?= $author->getCountry(); ?></p>
			</div>
			<p class="profile-interests-list"><?= $author->getDescription(); ?></p>
		</div>

	</section>
<?php } ?>
<section class="profile-modif">
	<ul class="tabs">
		<li class="tab" data-tab="profile">Profil <?= icon('user-round'); ?></li>
        <?php if ($this->hasRole(\Core\Enum\Role::ROLE_AUTHOR)) { ?>
			<li class="tab" data-tab="photographe">Information photographe <?= icon('camera'); ?></li>
        <?php } ?>
	</ul>
	<div class="tab-content" id="profile">
        <?= $this->component('form', $formProfile); ?>
	</div>
	<div class="tab-content" id="photographe">
        <?= $this->component('form', $formAuthor); ?>
	</div>
</section>



<section class="profile-action">
	<a class="button button-blue button-lg " href="/forgot-password">changer le password</a>
	<form method="POST" action="/profile/delete"
	      onsubmit="return confirm('Etes vous vraiment sur ?')">
		<button class="button button-red button-lg" type="submit">Supprimer le compte</button>
		<input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
	</form>
	<form method="POST" action="/profile/hard-delete"
	      onsubmit="return confirm('Etes vous vraiment sur ?')">
		<button class="button button-red button-lg" type="submit">Supprimer le compte définitivement</button>
		<input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
	</form>
</section>
