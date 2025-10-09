// Performance Optimization JavaScript

class PerformanceManager {
    constructor() {
        this.metrics = {};
        this.observers = [];
        this.isMonitoring = false;
        
        this.init();
    }
    
    init() {
        this.setupPerformanceObserver();
        this.setupIntersectionObserver();
        this.setupResourceOptimization();
        this.setupCriticalPathOptimization();
        this.measureInitialLoad();
    }
    
    setupPerformanceObserver() {
        if ('PerformanceObserver' in window) {
            // Core Web Vitals monitoring
            const observer = new PerformanceObserver((list) => {
                for (const entry of list.getEntries()) {
                    this.recordMetric(entry.entryType, entry);
                }
            });
            
            try {
                observer.observe({ type: 'largest-contentful-paint', buffered: true });
                observer.observe({ type: 'first-input', buffered: true });
                observer.observe({ type: 'layout-shift', buffered: true });
                observer.observe({ type: 'navigation', buffered: true });
                observer.observe({ type: 'resource', buffered: true });
                
                this.observers.push(observer);
            } catch (e) {
                console.warn('[Performance] PerformanceObserver not fully supported:', e);
            }
        }
    }
    
    setupIntersectionObserver() {
        // Lazy load images and components
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.add('loaded');
                            img.removeAttribute('data-src');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            }, { threshold: 0.1 });
            
            // Observe all images with data-src
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
            
            this.observers.push(imageObserver);
        }
    }
    
    setupResourceOptimization() {
        // Preload critical resources
        this.preloadCriticalResources();
        
        // Optimize third-party scripts
        this.optimizeThirdPartyScripts();
        
        // Setup service worker communication
        this.setupServiceWorkerOptimization();
    }
    
    preloadCriticalResources() {
        const criticalResources = [
            { href: 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', as: 'style' },
            { href: window.__BASE_PATH__ + '/assets/app.css', as: 'style' },
            { href: window.__BASE_PATH__ + '/assets/accessibility.css', as: 'style' }
        ];
        
        criticalResources.forEach(resource => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.href = resource.href;
            link.as = resource.as;
            link.crossOrigin = 'anonymous';
            document.head.appendChild(link);
        });
    }
    
    optimizeThirdPartyScripts() {
        // Defer non-critical third-party scripts
        const scripts = document.querySelectorAll('script[src*="cdn"]');
        scripts.forEach(script => {
            if (!script.hasAttribute('defer') && !script.hasAttribute('async')) {
                script.defer = true;
            }
        });
    }
    
    setupServiceWorkerOptimization() {
        if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
            // Request resource caching
            navigator.serviceWorker.controller.postMessage({
                type: 'CACHE_RESOURCES',
                resources: this.getCriticalResources()
            });
        }
    }
    
    getCriticalResources() {
        return [
            window.__BASE_PATH__ + '/assets/app.css',
            window.__BASE_PATH__ + '/assets/app.js',
            window.__BASE_PATH__ + '/assets/accessibility.css',
            window.__BASE_PATH__ + '/assets/accessibility.js',
            window.__BASE_PATH__ + '/assets/performance.css',
            window.__BASE_PATH__ + '/assets/performance.js'
        ];
    }
    
    setupCriticalPathOptimization() {
        // Inline critical CSS for faster rendering
        this.inlineCriticalCSS();
        
        // Defer non-critical CSS
        this.deferNonCriticalCSS();
        
        // Optimize font loading
        this.optimizeFontLoading();
    }
    
    inlineCriticalCSS() {
        // This would be done at build time in production
        const criticalCSS = `
            .loading-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; }
            .skeleton { background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); }
        `;
        
        const style = document.createElement('style');
        style.textContent = criticalCSS;
        document.head.insertBefore(style, document.head.firstChild);
    }
    
    deferNonCriticalCSS() {
        const nonCriticalCSS = [
            window.__BASE_PATH__ + '/assets/component-library.css',
            window.__BASE_PATH__ + '/assets/enhanced-forms.css'
        ];
        
        // Load after initial render
        requestIdleCallback(() => {
            nonCriticalCSS.forEach(href => {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = href;
                document.head.appendChild(link);
            });
        });
    }
    
    optimizeFontLoading() {
        // Use font-display: swap for better performance
        if ('fonts' in document) {
            document.fonts.ready.then(() => {
                console.log('[Performance] All fonts loaded');
            });
        }
    }
    
    measureInitialLoad() {
        if ('performance' in window) {
            window.addEventListener('load', () => {
                setTimeout(() => {
                    const navigation = performance.getEntriesByType('navigation')[0];
                    const paintEntries = performance.getEntriesByType('paint');
                    
                    this.metrics.loadTime = navigation.loadEventEnd - navigation.loadEventStart;
                    this.metrics.domContentLoaded = navigation.domContentLoadedEventEnd - navigation.domContentLoadedEventStart;
                    
                    paintEntries.forEach(entry => {
                        this.metrics[entry.name] = entry.startTime;
                    });
                    
                    this.reportMetrics();
                }, 0);
            });
        }
    }
    
    recordMetric(type, entry) {
        if (!this.metrics[type]) this.metrics[type] = [];
        
        switch (type) {
            case 'largest-contentful-paint':
                this.metrics.lcp = entry.startTime;
                break;
            case 'first-input':
                this.metrics.fid = entry.processingStart - entry.startTime;
                break;
            case 'layout-shift':
                if (!entry.hadRecentInput) {
                    this.metrics.cls = (this.metrics.cls || 0) + entry.value;
                }
                break;
            case 'resource':
                if (entry.duration > 100) { // Slow resources
                    this.metrics.slowResources = this.metrics.slowResources || [];
                    this.metrics.slowResources.push({
                        name: entry.name,
                        duration: entry.duration
                    });
                }
                break;
        }
    }
    
    reportMetrics() {
        console.group('[Performance] Core Web Vitals');
        console.log('LCP (Largest Contentful Paint):', this.metrics.lcp?.toFixed(2), 'ms');
        console.log('FID (First Input Delay):', this.metrics.fid?.toFixed(2), 'ms');
        console.log('CLS (Cumulative Layout Shift):', this.metrics.cls?.toFixed(3));
        console.log('Load Time:', this.metrics.loadTime?.toFixed(2), 'ms');
        console.groupEnd();
        
        // Send to analytics if needed
        this.sendToAnalytics();
    }
    
    sendToAnalytics() {
        // In production, send metrics to your analytics service
        if (typeof gtag !== 'undefined') {
            gtag('event', 'performance_metrics', {
                custom_map: {
                    lcp: this.metrics.lcp,
                    fid: this.metrics.fid,
                    cls: this.metrics.cls
                }
            });
        }
    }
    
    showPerformanceOverlay() {
        const overlay = document.createElement('div');
        overlay.className = 'performance-overlay show';
        overlay.innerHTML = `
            <div>LCP: ${this.metrics.lcp?.toFixed(0) || 'N/A'}ms</div>
            <div>FID: ${this.metrics.fid?.toFixed(0) || 'N/A'}ms</div>
            <div>CLS: ${this.metrics.cls?.toFixed(3) || 'N/A'}</div>
            <div>Load: ${this.metrics.loadTime?.toFixed(0) || 'N/A'}ms</div>
        `;
        
        document.body.appendChild(overlay);
        
        setTimeout(() => {
            overlay.remove();
        }, 5000);
    }
    
    // Utility methods for other scripts
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
    
    // Memory management
    cleanup() {
        this.observers.forEach(observer => observer.disconnect());
        this.observers = [];
        this.metrics = {};
    }
}

// Initialize performance manager
const performanceManager = new PerformanceManager();

// Keyboard shortcut to show performance metrics (Ctrl+Shift+P)
document.addEventListener('keydown', (e) => {
    if (e.ctrlKey && e.shiftKey && e.key === 'P') {
        e.preventDefault();
        performanceManager.showPerformanceOverlay();
    }
});

// Expose utilities globally
window.performance = window.performance || {};
window.performance.manager = performanceManager;
window.performance.debounce = performanceManager.debounce;
window.performance.throttle = performanceManager.throttle;

// Clean up on page unload
window.addEventListener('beforeunload', () => {
    performanceManager.cleanup();
});

// Request idle callback polyfill
window.requestIdleCallback = window.requestIdleCallback || function(cb) {
    const start = Date.now();
    return setTimeout(() => {
        cb({
            didTimeout: false,
            timeRemaining() {
                return Math.max(0, 50 - (Date.now() - start));
            }
        });
    }, 1);
};

window.cancelIdleCallback = window.cancelIdleCallback || function(id) {
    clearTimeout(id);
};