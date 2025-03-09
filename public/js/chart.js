// Chart1
const ctx = document.getElementById('myChart').getContext('2d');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        // labels: ['Male', 'Female'],
        datasets: [{
            label: 'Student Distribution',
            data: [60, 40],
            backgroundColor: ['#11117E', '#e74c3c'],
            // borderColor: ['#ffff', '#ffffff'],
            borderWidth: 1

        }]
    },
    options: {
        plugins: {
            // legend: {
            //     display: true,
            //     position: 'bottom',
            //     labels: {
            //         color: '#11117E',
            //         font: {
            //             size: 8
            //         }
            //     }
            // },
            tooltip: {
                callbacks: {
                    label: function (tooltipItem) {
                        let total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                        let value = tooltipItem.raw;
                        let percentage = ((value / total) * 100).toFixed(2) + '%';
                        return `${tooltipItem.label}: ${percentage}`;
                    }
                }
            }
        },
        animation: {
            animateRotate: true,
            animateScale: true,
            duration: 2000,
            easing: 'easeOutBounce'
        },
        hover: {
            mode: 'nearest',
            intersect: true
        }
    }
});

// chart2

const ctx1 = document.getElementById('myChart1').getContext('2d');

new Chart(ctx1, {
    type: 'doughnut',
    data: {
        // labels: ['Male', 'Female'],
        datasets: [{
            label: 'Student Distribution',
            data: [60, 40],
            backgroundColor: ['#11117E', '#e74c3c'],
            // borderColor: ['#ffff', '#ffffff'],
            borderWidth: 1

        }]
    },
    options: {
        plugins: {
            // legend: {
            //     display: true,
            //     position: 'bottom',
            //     labels: {
            //         color: '#11117E',
            //         font: {
            //             size: 8
            //         }
            //     }
            // },
            tooltip: {
                callbacks: {
                    label: function (tooltipItem) {
                        let total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                        let value = tooltipItem.raw;
                        let percentage = ((value / total) * 100).toFixed(2) + '%';
                        return `${tooltipItem.label}: ${percentage}`;
                    }
                }
            }
        },
        animation: {
            animateRotate: true,
            animateScale: true,
            duration: 2000,
            easing: 'easeOutBounce'
        },
        hover: {
            mode: 'nearest',
            intersect: true
        }
    }
});

const ctx2 = document.getElementById('attendanceChart').getContext('2d');

new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Fri', 'Sat'],	
        datasets: [{
            label: 'Present',
            data: [30, 28, 32, 31, 29],
            backgroundColor: 'green'
        }, {
            label: 'Absent',
            data: [5, 7, 3, 4, 6],
            backgroundColor: 'red'
        }]
    },
    options: {
        responsive: true,
        // maintainAspectRatio: false,
        scales: {
            y: { beginAtZero: true }
        }
    }
});


const ctx3 = document.getElementById('departmentChart').getContext('2d');

new Chart(ctx3, {
    type: 'line',
    data: {
        labels: ['2020', '2021', '2022', '2023'],
        datasets: [
            {
                label: 'Science',
                data: [120, 140, 150, 160],
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.1)',
                fill: true
            },
            {
                label: 'Social',
                data: [100, 110, 130, 125],
                borderColor: 'orange',
                backgroundColor: 'rgba(255, 165, 0, 0.1)',
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        // maintainAspectRatio: false,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
