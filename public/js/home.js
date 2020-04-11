"use strict"

var ctx = document.getElementById('chart-siswa').getContext('2d')
var chartSiswa = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
            data: [
                80, 50, 40, 30, 100
            ],
            backgroundColor: [
                '#6777ef',
                '#fc544b',
                '#ffa426',
                '#63ed7a',
                '#191d21',
            ],
            label: 'chart siswa'
        }],
        labels: [
            'Kelas 1A', 'Kelas 1B', 'Kelas2', 'Kelas3', 'Kelas4' 
        ],
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
        }
    }
})