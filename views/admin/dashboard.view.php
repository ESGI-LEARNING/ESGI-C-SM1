<div class="admin-container">
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
            <li class="dashboard-card">
                <h3>Statistiques des commentaires</h3>
                <canvas id="commentDonut"></canvas>
            </li>
            <li class="dashboard-card">
                <h3>Statistiques des utilisateurs</h3>
                <canvas id="userDonut" ></canvas>
            </li>
        </ul>
    </section>
</div>
<script>
    const [nbUsers, nbComments, nbImages, nbDeletedUsers, nbReportedComments, nbDeletedComments] = [<?= $nbUsers ?>, <?= $nbComments ?>, <?= $nbImages ?>, <?= $nbDeletedUsers ?>, <?= $nbReportedComments ?>, <?= $nbDeletedComments ?>];
</script>
