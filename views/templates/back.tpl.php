<?= $this->component('meta', $config = []); ?>
<body>
<header>
    <?= $this->component('navbarAdmin', $config = []); ?>
</header>
<main class="main-admin">
    <?= $this->component('darkMode', $config = []); ?>
    <?= $this->component('flash', $config = []); ?>
	<div class="admin-container">
        <?= $this->component('sideBarAdmin', $config = []); ?>
        <?php include $this->viewName; ?>
	</div>
</main>
</body>
</html>