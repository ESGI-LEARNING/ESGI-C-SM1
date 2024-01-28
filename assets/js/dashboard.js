import Chart from 'chart.js/auto';

const ctxComment = document.getElementById('commentDonut').getContext('2d');
const commentDonutChart = new Chart(ctxComment, {
    type: 'pie',
    data: {
        labels: ['Commentaires', 'Commentaires signalés', 'Commentaires supprimés'],
        datasets: [{
            label: 'Nombre de commentaires',
            data: [nbComments, nbReportedComments, nbDeletedComments],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {}
});

const ctxUser = document.getElementById('userDonut').getContext('2d');
const userDonutChart = new Chart(ctxUser, {
    type: 'doughnut',
    data: {
        labels: ['Utilisateurs actifs', 'Utilisateurs supprimés'],
        datasets: [{
            label: 'Nombre d\'utilisateurs',
            data: [nbUsers, nbDeletedUsers],
            backgroundColor: [
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {}
});
