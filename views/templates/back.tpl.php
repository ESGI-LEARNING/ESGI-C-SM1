<?= $this->component('meta', $config = []); ?>
<body>
<header>
    <?= $this->component('navbarAdmin', $config = []); ?>
</header>
<main class="main-admin">
    <?= $this->component('darkMode', $config = []); ?>
    <?= include $this->viewName; ?>
</main>
</body>
</html>