// =============================================================================
// PERFORMANCE MONITORING SYSTEM
// Tracks and reports performance metrics
// =============================================================================

class PerformanceMonitor {
  constructor(options = {}) {
    this.options = {
      enableReporting: true,
      enableMetrics: true,
      enableResourceTiming: true,
      enableUserTiming: true,
      enableLCP: true,
      enableFID: true,
      enableCLS: true,
      reportInterval: 30000, // 30 seconds
      ...options
    };
    
    this.metrics = {};
    this.resourceTimings = [];
    this.userTimings = [];
    this.observers = [];
    
    this.init();
  }
  
  init() {
    if (!this.options.enableMetrics) return;
    
    this.setupPerformanceObserver();
    this.setupResourceTiming();
    this.setupUserTiming();
    this.setupCoreWebVitals();
    this.setupPerformanceAPI();
    this.setupReporting();
    
    console.log('📊 Performance monitoring initialized');
  }
  
  setupPerformanceObserver() {
    if (!('PerformanceObserver' in window)) return;
    
    // Observe navigation timing
    try {
      const navObserver = new PerformanceObserver((list) => {
        const entries = list.getEntries();
        entries.forEach(entry => {
          this.handleNavigationTiming(entry);
        });
      });
      navObserver.observe({ entryTypes: ['navigation'] });
      this.observers.push(navObserver);
    } catch (e) {
      console.warn('Navigation timing observation not supported');
    }
    
    // Observe resource timing
    if (this.options.enableResourceTiming) {
      try {
        const resourceObserver = new PerformanceObserver((list) => {
          const entries = list.getEntries();
          entries.forEach(entry => {
            this.handleResourceTiming(entry);
          });
        });
        resourceObserver.observe({ entryTypes: ['resource'] });
        this.observers.push(resourceObserver);
      } catch (e) {
        console.warn('Resource timing observation not supported');
      }
    }
    
    // Observe paint timing
    try {
      const paintObserver = new PerformanceObserver((list) => {
        const entries = list.getEntries();
        entries.forEach(entry => {
          this.handlePaintTiming(entry);
        });
      });
      paintObserver.observe({ entryTypes: ['paint'] });
      this.observers.push(paintObserver);
    } catch (e) {
      console.warn('Paint timing observation not supported');
    }
  }
  
  setupResourceTiming() {
    if (!this.options.enableResourceTiming) return;
    
    // Get existing resource timings
    if ('performance' in window && 'getEntriesByType' in performance) {
      const resources = performance.getEntriesByType('resource');
      resources.forEach(resource => {
        this.handleResourceTiming(resource);
      });
    }
  }
  
  setupUserTiming() {
    if (!this.options.enableUserTiming) return;
    
    // Get existing user timings
    if ('performance' in window && 'getEntriesByType' in performance) {
      const userTimings = performance.getEntriesByType('measure');
      userTimings.forEach(timing => {
        this.handleUserTiming(timing);
      });
    }
  }
  
  setupCoreWebVitals() {
    // Largest Contentful Paint (LCP)
    if (this.options.enableLCP) {
      this.observeLCP();
    }
    
    // First Input Delay (FID)
    if (this.options.enableFID) {
      this.observeFID();
    }
    
    // Cumulative Layout Shift (CLS)
    if (this.options.enableCLS) {
      this.observeCLS();
    }
  }
  
  setupPerformanceAPI() {
    // Monitor memory usage if available
    if ('memory' in performance) {
      this.monitorMemoryUsage();
    }
    
    // Monitor connection information
    if ('connection' in navigator) {
      this.monitorConnection();
    }
  }
  
  setupReporting() {
    if (!this.options.enableReporting) return;
    
    // Report metrics periodically
    setInterval(() => {
      this.reportMetrics();
    }, this.options.reportInterval);
    
    // Report metrics on page unload
    window.addEventListener('beforeunload', () => {
      this.reportMetrics(true);
    });
    
    // Report metrics when page becomes hidden
    document.addEventListener('visibilitychange', () => {
      if (document.visibilityState === 'hidden') {
        this.reportMetrics(true);
      }
    });
  }
  
  observeLCP() {
    if (!('PerformanceObserver' in window)) return;
    
    try {
      const lcpObserver = new PerformanceObserver((list) => {
        const entries = list.getEntries();
        const lastEntry = entries[entries.length - 1];
        this.metrics.lcp = lastEntry.startTime;
        this.logMetric('LCP', lastEntry.startTime);
      });
      lcpObserver.observe({ entryTypes: ['largest-contentful-paint'] });
      this.observers.push(lcpObserver);
    } catch (e) {
      console.warn('LCP observation not supported');
    }
  }
  
  observeFID() {
    if (!('PerformanceObserver' in window)) return;
    
    try {
      const fidObserver = new PerformanceObserver((list) => {
        const entries = list.getEntries();
        entries.forEach(entry => {
          this.metrics.fid = entry.processingStart - entry.startTime;
          this.logMetric('FID', this.metrics.fid);
        });
      });
      fidObserver.observe({ entryTypes: ['first-input'] });
      this.observers.push(fidObserver);
    } catch (e) {
      console.warn('FID observation not supported');
    }
  }
  
  observeCLS() {
    if (!('PerformanceObserver' in window)) return;
    
    try {
      let clsValue = 0;
      const clsObserver = new PerformanceObserver((list) => {
        const entries = list.getEntries();
        entries.forEach(entry => {
          if (!entry.hadRecentInput) {
            clsValue += entry.value;
          }
        });
        this.metrics.cls = clsValue;
        this.logMetric('CLS', clsValue);
      });
      clsObserver.observe({ entryTypes: ['layout-shift'] });
      this.observers.push(clsObserver);
    } catch (e) {
      console.warn('CLS observation not supported');
    }
  }
  
  monitorMemoryUsage() {
    setInterval(() => {
      const memory = performance.memory;
      this.metrics.memory = {
        used: memory.usedJSHeapSize,
        total: memory.totalJSHeapSize,
        limit: memory.jsHeapSizeLimit
      };
    }, 5000);
  }
  
  monitorConnection() {
    const connection = navigator.connection;
    this.metrics.connection = {
      effectiveType: connection.effectiveType,
      downlink: connection.downlink,
      rtt: connection.rtt,
      saveData: connection.saveData
    };
  }
  
  handleNavigationTiming(entry) {
    this.metrics.navigation = {
      domContentLoaded: entry.domContentLoadedEventEnd - entry.domContentLoadedEventStart,
      loadComplete: entry.loadEventEnd - entry.loadEventStart,
      domInteractive: entry.domInteractive - entry.fetchStart,
      totalTime: entry.loadEventEnd - entry.fetchStart
    };
    
    this.logMetric('DOM Content Loaded', this.metrics.navigation.domContentLoaded);
    this.logMetric('Load Complete', this.metrics.navigation.loadComplete);
    this.logMetric('Total Load Time', this.metrics.navigation.totalTime);
  }
  
  handleResourceTiming(entry) {
    const resource = {
      name: entry.name,
      type: this.getResourceType(entry),
      duration: entry.duration,
      size: entry.transferSize,
      startTime: entry.startTime
    };
    
    this.resourceTimings.push(resource);
    
    // Keep only last 100 resource timings
    if (this.resourceTimings.length > 100) {
      this.resourceTimings.shift();
    }
  }
  
  handlePaintTiming(entry) {
    this.metrics[entry.name] = entry.startTime;
    this.logMetric(entry.name, entry.startTime);
  }
  
  handleUserTiming(timing) {
    this.userTimings.push({
      name: timing.name,
      duration: timing.duration,
      startTime: timing.startTime
    });
    
    // Keep only last 50 user timings
    if (this.userTimings.length > 50) {
      this.userTimings.shift();
    }
  }
  
  getResourceType(entry) {
    if (entry.name.includes('.css')) return 'stylesheet';
    if (entry.name.includes('.js')) return 'script';
    if (entry.name.match(/\.(jpg|jpeg|png|gif|svg|webp)$/)) return 'image';
    if (entry.name.match(/\.(woff|woff2|ttf|eot)$/)) return 'font';
    return 'other';
  }
  
  logMetric(name, value) {
    console.log(`📊 ${name}: ${Math.round(value)}ms`);
  }
  
  reportMetrics(isFinal = false) {
    if (!this.options.enableReporting) return;
    
    const report = {
      timestamp: Date.now(),
      url: window.location.href,
      metrics: this.metrics,
      resourceTimings: this.resourceTimings.slice(-20), // Last 20 resources
      userTimings: this.userTimings.slice(-10), // Last 10 user timings
      isFinal: isFinal
    };
    
    // Send to analytics endpoint (implement based on your analytics system)
    this.sendToAnalytics(report);
    
    // Store locally for debugging
    if (!isFinal) {
      localStorage.setItem('performance-metrics', JSON.stringify(report));
    }
  }
  
  sendToAnalytics(report) {
    // Implement your analytics reporting here
    // Example: Send to Google Analytics, custom endpoint, etc.
    
    if (typeof gtag !== 'undefined') {
      // Google Analytics 4
      gtag('event', 'performance_metrics', {
        event_category: 'Performance',
        event_label: 'Metrics',
        custom_parameters: report
      });
    }
    
    // Custom endpoint
    if (window.__BASE_PATH__) {
      fetch(`${window.__BASE_PATH__}/api/analytics/performance`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(report)
      }).catch(error => {
        console.warn('Failed to send performance metrics:', error);
      });
    }
  }
  
  // Public methods
  mark(name) {
    if ('performance' in window && 'mark' in performance) {
      performance.mark(name);
    }
  }
  
  measure(name, startMark, endMark) {
    if ('performance' in window && 'measure' in performance) {
      try {
        performance.measure(name, startMark, endMark);
      } catch (e) {
        console.warn('Failed to measure performance:', e);
      }
    }
  }
  
  getMetrics() {
    return { ...this.metrics };
  }
  
  getResourceTimings() {
    return [...this.resourceTimings];
  }
  
  getUserTimings() {
    return [...this.userTimings];
  }
  
  disconnect() {
    this.observers.forEach(observer => {
      observer.disconnect();
    });
    this.observers = [];
  }
  
  // Utility method to measure function execution time
  measureFunction(name, fn) {
    this.mark(`${name}-start`);
    const result = fn();
    this.mark(`${name}-end`);
    this.measure(name, `${name}-start`, `${name}-end`);
    return result;
  }
  
  // Utility method to measure async function execution time
  async measureAsyncFunction(name, fn) {
    this.mark(`${name}-start`);
    const result = await fn();
    this.mark(`${name}-end`);
    this.measure(name, `${name}-start`, `${name}-end`);
    return result;
  }
}

// Initialize performance monitoring when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  window.PerformanceMonitor = PerformanceMonitor;
  
  // Auto-initialize if not disabled
  if (!window.__DISABLE_PERFORMANCE_MONITORING__) {
    window.performanceMonitor = new PerformanceMonitor();
  }
});

// Export for use in other modules
window.PerformanceMonitor = PerformanceMonitor;
