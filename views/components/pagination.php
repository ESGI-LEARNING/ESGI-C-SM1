<?php if ($config['total_pages'] !== 1) { ?>
    <nav>
        <ul class="pagination">
            <?php if ($config['current_page'] > 1) { ?>
                <li class="page-item">
                    <a href="?page=<?= $config['current_page'] - 1; ?>" class="page-link">
                        <?= icon('chevrons-left'); ?>
                    </a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled">
                    <span><?= icon('chevrons-left'); ?></span>
                </li>
            <?php } ?>

            <?php
                $start_page = max(1, $config['current_page'] - 4);
                $end_page = min($config['total_pages'], $start_page + 9);

                if ($start_page > 1) {
                    echo '<li class="page-item disabled"><span>...</span></li>';
                }

                for ($page = $start_page; $page <= $end_page; ++$page) { ?>
                    <li class="page-item <?= ($config['current_page'] == $page) ? 'active' : ''; ?>">
                        <a href="?page=<?= $page; ?>" class="page-link"><?= $page; ?></a>
                    </li>
                <?php }

                if ($end_page < $config['total_pages']) {
                    echo '<li class="page-item disabled"><span>...</span></li>';
                }
            ?>

            <?php if ($config['current_page'] < $config['total_pages']) { ?>
                <li class="page-item">
                    <a href="?page=<?= $config['current_page'] + 1; ?>" class="page-link">
                        <?= icon('chevrons-right'); ?>
                    </a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled">
                    <span><?= icon('chevrons-right'); ?></span>
                </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>