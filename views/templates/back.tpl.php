<?= $this->component('meta', $config = []); ?>
<body>
<header>
    <?= $this->component('navbarAdmin', $config = []); ?>
</header>
<main class="main-admin">
    <?= $this->component('darkMode', $config = []); ?>
	<div class="admin-container">
        <?= $this->component('sideBarAdmin', $config = []); ?>
        <section class="table-view-container">
            <?= $this->component('flash', $this->flash() ?? []); ?>
            <?php include $this->viewName; ?>
        </section>
    </div>
</main>
</body>
</html>