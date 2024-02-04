<?php if ($config['total_pages'] !== 1): ?>
    <nav>
        <ul class="pagination">
            <?php if ($config['current_page'] > 1): ?>
                <li class="page-item">
                    <a href="?page=<?= $config['current_page'] - 1 ?>" class="page-link">
                        <?= icon("chevrons-left") ?>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span><?= icon("chevrons-left") ?></span>
                </li>
            <?php endif; ?>

            <?php for ($page = 1; $page <= $config['total_pages']; $page++): ?>
                <li class="page-item <?= ($config['current_page'] == $page) ? "active" : "" ?>">
                    <a href="?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($config['current_page'] < $config['total_pages']): ?>
                <li class="page-item">
                    <a href="?page=<?= $config['current_page'] + 1 ?>" class="page-link">
                        <?= icon("chevrons-right") ?>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span><?= icon("chevrons-right") ?></span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>