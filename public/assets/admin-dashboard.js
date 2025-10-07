// Admin Dashboard Advanced Analytics and Charts
document.addEventListener('DOMContentLoaded', function() {
    // Animate counters
    function animateCounters() {
        const counters = document.querySelectorAll('[data-count-to]');
        counters.forEach(counter => {
            const target = parseFloat(counter.getAttribute('data-count-to'));
            const decimals = counter.getAttribute('data-count-decimals') || 0;
            const duration = 2000;
            const start = performance.now();
            
            function updateCounter(currentTime) {
                const elapsed = currentTime - start;
                const progress = Math.min(elapsed / duration, 1);
                const current = progress * target;
                
                if (decimals > 0) {
                    counter.textContent = current.toFixed(decimals);
                } else {
                    counter.textContent = Math.floor(current);
                }
                
                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                }
            }
            
            requestAnimationFrame(updateCounter);
        });
    }
    
    // Animate progress bars
    function animateProgressBars() {
        const progressBars = document.querySelectorAll('[data-progress-to]');
        progressBars.forEach(bar => {
            const target = parseFloat(bar.getAttribute('data-progress-to'));
            const duration = 1500;
            const start = performance.now();
            
            function updateProgress(currentTime) {
                const elapsed = currentTime - start;
                const progress = Math.min(elapsed / duration, 1);
                const current = progress * target;
                
                bar.style.width = current + '%';
                
                if (progress < 1) {
                    requestAnimationFrame(updateProgress);
                }
            }
            
            requestAnimationFrame(updateProgress);
        });
    }
    
    // Initialize School Analytics Chart
    function initSchoolAnalyticsChart() {
        const ctx = document.getElementById('schoolAnalyticsChart');
        if (!ctx) return;
        
        new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Students',
                        data: [120, 135, 142, 138, 145, 150, 155, 160, 165, 170, 175, 180],
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#0d6efd',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    },
                    {
                        label: 'Teachers',
                        data: [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26],
                        borderColor: '#198754',
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#198754',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    },
                    {
                        label: 'Parents',
                        data: [80, 85, 90, 88, 92, 95, 98, 100, 105, 110, 115, 120],
                        borderColor: '#0dcaf0',
                        backgroundColor: 'rgba(13, 202, 240, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#0dcaf0',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        },
                        ticks: {
                            color: '#6c757d'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6c757d'
                        }
                    }
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#0d6efd'
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }
    
    // Initialize User Distribution Chart
    function initUserDistributionChart() {
        const ctx = document.getElementById('userDistributionChart');
        if (!ctx) return;
        
        new Chart(ctx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Students', 'Teachers', 'Parents', 'Admins'],
                datasets: [{
                    data: [180, 26, 120, 3],
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#0dcaf0',
                        '#6f42c1'
                    ],
                    borderColor: [
                        '#0d6efd',
                        '#198754',
                        '#0dcaf0',
                        '#6f42c1'
                    ],
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                cutout: '60%',
                elements: {
                    arc: {
                        borderWidth: 2
                    }
                }
            }
        });
    }
    
    // Add scroll animations
    function addScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe all cards
        document.querySelectorAll('.stat-card, .action-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    }
    
    // Initialize all animations and charts
    setTimeout(() => {
        animateCounters();
        animateProgressBars();
        initSchoolAnalyticsChart();
        initUserDistributionChart();
        addScrollAnimations();
    }, 500);
    
    // Add enhanced hover effects for cards
    document.querySelectorAll('.stat-card, .action-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
            this.style.boxShadow = '0 15px 35px rgba(0,0,0,0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = 'none';
        });
    });
    
    // Add click animations for buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Real-time data updates simulation (disabled to prevent conflicts)
    function simulateRealTimeUpdates() {
        // Commented out to prevent DOM manipulation conflicts
        // setInterval(() => {
        //     const activeSessions = document.querySelector('.text-info');
        //     if (activeSessions) {
        //         const currentSessions = parseInt(activeSessions.textContent);
        //         const newSessions = currentSessions + Math.floor(Math.random() * 3) - 1;
        //         activeSessions.textContent = Math.max(10, Math.min(20, newSessions));
        //     }
        // }, 5000);
    }
    
    // simulateRealTimeUpdates(); // Disabled
});

// Add CSS for ripple effect (with duplicate prevention)
if (!document.querySelector('#admin-dashboard-styles')) {
    const style = document.createElement('style');
    style.id = 'admin-dashboard-styles';
    style.textContent = `
        .btn {
            position: relative;
            overflow: hidden;
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .action-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }
    `;
    document.head.appendChild(style);
}
