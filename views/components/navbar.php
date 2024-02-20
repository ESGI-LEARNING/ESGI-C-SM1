<h1><a href="/"><?= config('app.name'); ?></a></h1>
<nav>
	<ul class="menu">
        <?php foreach ($this->menu() as $item) { ?>
			<li><a href="<?= $item->slug; ?>"><?= $item->name; ?></a></li>
        <?php } ?>
        <?php
        if (Core\Auth\Auth::check()) {
            echo '<li><a href="/profile">' . icon('user-round') . '</a></li>';
            if ($this->hasRole(\Core\Enum\Role::ROLE_ADMIN)) {
                echo '<li><a href="/admin">' . icon('settings') . '</a></li>';
            }
            echo '<li><a href="/logout">' . icon('log-out') . '</a></li>';
        } else {
            echo '<li><a href="/login">' . icon('log-in') . '</a></li>';
        }
        ?>
	</ul>
	<div class="burger">
		<span class="burger-icon">&#9776;</span>
	</div>
</nav>
