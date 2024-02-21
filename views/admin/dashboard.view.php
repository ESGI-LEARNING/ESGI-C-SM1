    <section class="dashboard-container">
        <h2>Tableau de bord</h2>
        <ul class="dashboard-list">
            <li class="dashboard-card">
                <h3>Nombre de commentaires</h3>
                <p><?= $nbComments; ?></p>
            </li>
            <li class="dashboard-card">
                <h3>Nombre de pages</h3>
                <p>0</p>
            </li>
            <li class="dashboard-card">
                <h3>Nombre d'utilisateurs</h3>
                <p><?= $nbUsers; ?></p>
            </li>
            <li class="dashboard-card">
                <h3>Nombre d'images</h3>
                <p><?= $nbImages; ?></p>
            </li>
        </ul>
    </section>
    <section>
        <div class="flex gap-2">
            <div class="dashboard-card-stats">
                <h3>Statistiques des commentaires</h3>
                    <canvas id="commentDonut"></canvas>
            </div>
            <div class="dashboard-card-stats">
                    <h3>Statistiques des utilisateurs</h3>
                <canvas id="userDonut"></canvas>
            </div>
        </div>
    </section>

<script>
    const [nbUsers, nbComments, nbImages, nbDeletedUsers, nbReportedComments, nbDeletedComments] = [<?= $nbUsers ?>, <?= $nbComments ?>, <?= $nbImages ?>, <?= $nbDeletedUsers ?>, <?= $nbReportedComments ?>, <?= $nbDeletedComments ?>];
</script>
