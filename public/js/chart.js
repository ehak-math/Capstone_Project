// teacherChart
const ctx = document.getElementById('teacherChart').getContext('2d');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        // labels: ['Male', 'Female'],
        datasets: [{
            label: 'Teacher Distribution',
            data: teacherGenderData,
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

// studentChart

const ctx1 = document.getElementById('studentChart').getContext('2d');

new Chart(ctx1, {
    type: 'doughnut',
    data: {
        // labels: ['Male', 'Female'],
        datasets: [{
            label: 'Student Distribution',
            data: studentGenderData,
            backgroundColor: ['#11117E', '#e74c3c'],
            borderWidth: 1

        }]
    },
    options: {
        plugins: {
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
