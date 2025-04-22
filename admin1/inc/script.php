// SIDEBAR ACTIVE METHOD
const allSideMenu = document.querySelectorAll('#sidebar ul li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});

$(document).ready(function() {
            // Toggle sidebar
            $('#sidebarToggle').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
            });

            // Initialize traffic chart
            const trafficCtx = document.getElementById('trafficChart');
            if (trafficCtx) {
                new Chart(trafficCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Page Views',
                            data: [4215, 5312, 6251, 7841, 9821, 14984, 15984, 16984, 14587, 10000, 10241, 11000],
                            fill: true,
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            tension: 0.3,
                            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                            pointHitRadius: 10,
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: "rgb(255, 255, 255)",
                                bodyColor: "#858796",
                                titleColor: "#6e707e",
                                titleFontSize: 14,
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10
                            }
                        }
                    }
                });
            }

            // Initialize sources chart
            const sourcesCtx = document.getElementById('sourcesChart');
            if (sourcesCtx) {
                new Chart(sourcesCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Direct', 'Social', 'Referral', 'Organic'],
                        datasets: [{
                            data: [55, 30, 15, 10],
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#e0af12'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom'
                            },
                            tooltip: {
                                backgroundColor: "rgb(255, 255, 255)",
                                bodyColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                            }
                        }
                    }
                });
            }

            // Delete confirmation
            $('.btn-danger').on('click', function() {
                if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                    alert('Deleted Successfully!');
                }
            });
        });