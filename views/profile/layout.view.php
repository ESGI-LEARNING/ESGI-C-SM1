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
                <p class="profile-info"><?= icon('user-round'); ?> <?= $author->firstname ?? ''; ?> <?= $author->lastname ?? ''; ?></p>
            </div>
            <div class="profile-sub-info">
                <p class="profile-info"><?= icon('mail'); ?> <?= $user->email; ?></p>
                <p class="profile-info"><?= icon('building'); ?> <?= $author->city    ?? ''; ?></p>
                <p class="profile-info"><?= icon('land-plot'); ?><?= $author->country ?? ''; ?></p>
            </div>
            <p class="profile-interests-list"><?= $author->description ?? ''; ?></p>
        </div>

    </section>
<?php } ?>
<section class="profile-modif">
    <ul class="tabs">
        <li class="tab <?= $this->rootIs('/profile') ? 'active' : ''; ?>">
	        <a href="/profile">Profil <?= icon('user-round'); ?></a>
        </li>
        <?php if ($this->hasRole(\Core\Enum\Role::ROLE_AUTHOR)) { ?>
            <li class="tab <?= $this->rootIs('/profile/author') ? 'active' : ''; ?>">
	            <a href="/profile/author">Information photographe <?= icon('camera'); ?><a>
            </li>
        <?php } ?>
	    <li class="tab <?= $this->rootIs('/profile/reset-password') ? 'active' : ''; ?>">
		    <a href="/profile/reset-password">Changer le mot de passe <?= icon('lock'); ?></a>
	    </li>
    </ul>
	<?php if ($this->rootIs('/profile')) { ?>
	    <div class="tab-content" id="profile">
	        <?= $this->component('form', $formProfile); ?>
	    </div>
	<?php } ?>
	<?php if ($this->rootIs('/profile/reset-password')) { ?>
	    <div class="tab-content" id="password">
	        <?= $this->component('form', $formResetPassword); ?>
	    </div>
	<?php } ?>
	<?php if ($this->rootIs('/profile/author')) { ?>
	    <div class="tab-content" id="photographe">
	        <?= $this->component('form', $formAuthor); ?>
	    </div>
	<?php } ?>

</section>