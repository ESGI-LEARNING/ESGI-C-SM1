<nav>
    <ul>
        <li><a href="/">accueil</a></li>
        <li><a href="/gallery">gallerie</a></li>
	    <li><a href="/artist">profil</a></li>
    </ul>
</nav>
<h1>Henri Cartier-Bresson</h1>
<nav>
    <ul>
        <li><a href="/contact">contact</a></li>
        <li><a href="/a-propos">a-propos</a></li>
	    <?php
            if (Core\Auth\Auth::check()) {
                echo '<li><a href="/profile">'.icon('user-round').'</a></li>';
                if ($this->hasRole(\Core\Enum\Role::ROLE_ADMIN)) {
                    echo '<li><a href="/admin">'.icon('settings').'</a></li>';
                }
                echo '<li><a href="/logout">'.icon('log-out').'</a></li>';
            } else {
                echo '<li><a href="/login">'.icon('log-in').'</a></li>';
            }
	    ?>
    </ul>
</nav>
