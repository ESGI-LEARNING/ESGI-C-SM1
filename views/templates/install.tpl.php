<?= $this->component('meta', $config = []); ?>
<body>
<main class="main-admin">
    <?= $this->component('flash', $this->flash() ?? []); ?>
    <?php include $this->viewName; ?>
</main>
</body>
</html>