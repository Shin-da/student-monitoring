// Admin Dashboard - Safe Version (No Infinite Loops)
document.addEventListener('DOMContentLoaded', function() {
    // Prevent multiple initializations
    if (window.adminDashboardInitialized) {
        console.log('Admin dashboard already initialized, skipping...');
        return;
    }
    window.adminDashboardInitialized = true;
    console.log('Initializing admin dashboard...');
    
    // Cleanup function to destroy charts
    function cleanupCharts() {
        if (window.schoolAnalyticsChartInstance) {
            window.schoolAnalyticsChartInstance.destroy();
            window.schoolAnalyticsChartInstance = null;
        }
        if (window.userDistributionChartInstance) {
            window.userDistributionChartInstance.destroy();
            window.userDistributionChartInstance = null;
        }
    }
    
    // Animate counters (safe version)
    function animateCounters() {
        if (window.countersAnimated) return;
        window.countersAnimated = true;
        
        const counters = document.querySelectorAll('[data-count-to]');
        console.log('Animating', counters.length, 'counters');
        
        counters.forEach(counter => {
            const target = parseFloat(counter.getAttribute('data-count-to'));
            if (isNaN(target)) return;
            
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
    
    // Animate progress bars (safe version)
    function animateProgressBars() {
        if (window.progressBarsAnimated) return;
        window.progressBarsAnimated = true;
        
        const progressBars = document.querySelectorAll('[data-progress-to]');
        console.log('Animating', progressBars.length, 'progress bars');
        
        progressBars.forEach(bar => {
            const target = parseFloat(bar.getAttribute('data-progress-to'));
            if (isNaN(target)) return;
            
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
    
    // Initialize School Analytics Chart (safe version)
    function initSchoolAnalyticsChart() {
        const ctx = document.getElementById('schoolAnalyticsChart');
        if (!ctx || window.schoolChartInitialized) {
            console.log('School chart not found or already initialized');
            return;
        }
        
        // Destroy any existing chart instance first
        if (window.schoolAnalyticsChartInstance) {
            try {
                window.schoolAnalyticsChartInstance.destroy();
            } catch (e) {
                console.log('Error destroying existing school chart:', e);
            }
            window.schoolAnalyticsChartInstance = null;
        }
        
        window.schoolChartInitialized = true;
        console.log('Initializing school analytics chart...');
        
        try {
            
            // Set fixed container height to prevent infinite growth
            const container = ctx.parentElement;
            if (container) {
                container.style.height = '300px';
                container.style.maxHeight = '300px';
                container.style.overflow = 'hidden';
            }
            
            // Set canvas dimensions
            ctx.style.maxHeight = '300px';
            ctx.style.height = '300px';
            
            window.schoolAnalyticsChartInstance = new Chart(ctx, {
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
                    aspectRatio: 2,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                boxWidth: 12
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
            
            // Force chart height after initialization
            setTimeout(() => {
                if (window.schoolAnalyticsChartInstance) {
                    const canvas = window.schoolAnalyticsChartInstance.canvas;
                    if (canvas) {
                        canvas.style.maxHeight = '300px';
                        canvas.style.height = '300px';
                        canvas.style.minHeight = '300px';
                        canvas.style.width = '100%';
                        canvas.style.maxWidth = '100%';
                    }
                    
                    // Force resize
                    window.schoolAnalyticsChartInstance.resize();
                }
            }, 100);
            
        } catch (error) {
            console.error('School chart initialization error:', error);
        }
    }
    
    // Initialize User Distribution Chart (safe version)
    function initUserDistributionChart() {
        const ctx = document.getElementById('userDistributionChart');
        if (!ctx || window.distributionChartInitialized) {
            console.log('Distribution chart not found or already initialized');
            return;
        }
        
        // Destroy any existing chart instance first
        if (window.userDistributionChartInstance) {
            try {
                window.userDistributionChartInstance.destroy();
            } catch (e) {
                console.log('Error destroying existing distribution chart:', e);
            }
            window.userDistributionChartInstance = null;
        }
        
        window.distributionChartInitialized = true;
        console.log('Initializing user distribution chart...');
        
        try {
            
            // Set fixed container height to prevent infinite growth
            const container = ctx.parentElement;
            if (container) {
                container.style.height = '280px';
                container.style.maxHeight = '280px';
                container.style.minHeight = '280px';
                container.style.overflow = 'hidden';
                container.style.position = 'relative';
            }
            
            // Set canvas dimensions with strict constraints
            ctx.style.maxHeight = '280px';
            ctx.style.height = '280px';
            ctx.style.minHeight = '280px';
            ctx.style.width = '100%';
            ctx.style.maxWidth = '100%';
            
            window.userDistributionChartInstance = new Chart(ctx, {
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
                    aspectRatio: 1,
                    layout: {
                        padding: {
                            top: 5,
                            bottom: 5,
                            left: 5,
                            right: 5
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 10,
                                boxWidth: 10,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    elements: {
                        arc: {
                            borderWidth: 1
                        }
                    },
                    cutout: '60%'
                }
            });
            
            // Force chart height after initialization
            setTimeout(() => {
                if (window.userDistributionChartInstance) {
                    const canvas = window.userDistributionChartInstance.canvas;
                    if (canvas) {
                        canvas.style.maxHeight = '280px';
                        canvas.style.height = '280px';
                        canvas.style.minHeight = '280px';
                        canvas.style.width = '100%';
                        canvas.style.maxWidth = '100%';
                    }
                    
                    // Force resize
                    window.userDistributionChartInstance.resize();
                }
            }, 100);
            
        } catch (error) {
            console.error('Distribution chart initialization error:', error);
        }
    }
    
    // Add scroll animations (safe version)
    function addScrollAnimations() {
        if (window.scrollAnimationsAdded) {
            console.log('Scroll animations already added');
            return;
        }
        window.scrollAnimationsAdded = true;
        console.log('Adding scroll animations...');
        
        try {
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
        } catch (error) {
            console.error('Scroll animations error:', error);
        }
    }
    
    // Monitor and fix chart heights
    function monitorChartHeights() {
        setInterval(() => {
            // Check user distribution chart
            const distributionCanvas = document.getElementById('userDistributionChart');
            if (distributionCanvas && distributionCanvas.offsetHeight > 300) {
                distributionCanvas.style.maxHeight = '280px';
                distributionCanvas.style.height = '280px';
                if (window.userDistributionChartInstance) {
                    window.userDistributionChartInstance.resize();
                }
            }
            
            // Check school analytics chart
            const analyticsCanvas = document.getElementById('schoolAnalyticsChart');
            if (analyticsCanvas && analyticsCanvas.offsetHeight > 350) {
                analyticsCanvas.style.maxHeight = '300px';
                analyticsCanvas.style.height = '300px';
                if (window.schoolAnalyticsChartInstance) {
                    window.schoolAnalyticsChartInstance.resize();
                }
            }
        }, 1000);
    }

    // Global cleanup function
    function cleanupDashboard() {
        // Reset chart initialization flags
        window.schoolChartInitialized = false;
        window.distributionChartInitialized = false;
        
        // Destroy existing chart instances
        if (window.schoolAnalyticsChartInstance) {
            try {
                window.schoolAnalyticsChartInstance.destroy();
            } catch (e) {
                console.log('Error destroying school chart during cleanup:', e);
            }
            window.schoolAnalyticsChartInstance = null;
        }
        
        if (window.userDistributionChartInstance) {
            try {
                window.userDistributionChartInstance.destroy();
            } catch (e) {
                console.log('Error destroying distribution chart during cleanup:', e);
            }
            window.userDistributionChartInstance = null;
        }
    }

    // Initialize all animations and charts (once only)
    try {
        console.log('Starting admin dashboard initialization...');
        
        // Clean up any existing instances first
        cleanupDashboard();
        
        setTimeout(() => {
            try {
                animateCounters();
                animateProgressBars();
                initSchoolAnalyticsChart();
                initUserDistributionChart();
                addScrollAnimations();
                monitorChartHeights();
                console.log('Admin dashboard initialization completed successfully');
            } catch (error) {
                console.error('Error during dashboard initialization:', error);
            }
        }, 500);
    } catch (error) {
        console.error('Error setting up dashboard initialization:', error);
    }
    
    // Add enhanced hover effects for cards (safe version)
    try {
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
    } catch (error) {
        console.error('Error adding hover effects:', error);
    }
    
    // Handle window resize to prevent chart issues
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            if (window.schoolAnalyticsChartInstance) {
                window.schoolAnalyticsChartInstance.resize();
            }
            if (window.userDistributionChartInstance) {
                window.userDistributionChartInstance.resize();
            }
        }, 250);
    });
    
    // Cleanup on page unload
    window.addEventListener('beforeunload', cleanupCharts);
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
