// =============================================================================
// LAZY LOADING SYSTEM
// Implements lazy loading for images, components, and other resources
// =============================================================================

class LazyLoadingSystem {
  constructor(options = {}) {
    this.options = {
      rootMargin: '50px 0px',
      threshold: 0.1,
      enableImages: true,
      enableComponents: true,
      enableCharts: true,
      enableIframes: true,
      ...options
    };
    
    this.observer = null;
    this.imageObserver = null;
    this.componentObserver = null;
    this.loadedElements = new Set();
    
    this.init();
  }
  
  init() {
    this.createObservers();
    this.setupImageLazyLoading();
    this.setupComponentLazyLoading();
    this.setupChartLazyLoading();
    this.setupIframeLazyLoading();
    this.setupIntersectionObserver();
    
    console.log('🔄 Lazy loading system initialized');
  }
  
  createObservers() {
    // Main observer for general lazy loading
    this.observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          this.handleIntersection(entry);
        }
      });
    }, {
      rootMargin: this.options.rootMargin,
      threshold: this.options.threshold
    });
    
    // Specialized observer for images
    if (this.options.enableImages) {
      this.imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            this.loadImage(entry.target);
          }
        });
      }, {
        rootMargin: '100px 0px',
        threshold: 0.01
      });
    }
    
    // Specialized observer for components
    if (this.options.enableComponents) {
      this.componentObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            this.loadComponent(entry.target);
          }
        });
      }, {
        rootMargin: this.options.rootMargin,
        threshold: this.options.threshold
      });
    }
  }
  
  setupImageLazyLoading() {
    if (!this.options.enableImages) return;
    
    // Find all images with data-src attribute
    const lazyImages = document.querySelectorAll('img[data-src]');
    
    lazyImages.forEach(img => {
      // Add loading placeholder
      this.addImagePlaceholder(img);
      
      // Start observing
      this.imageObserver.observe(img);
    });
    
    // Also handle images with loading="lazy" attribute
    const lazyNativeImages = document.querySelectorAll('img[loading="lazy"]');
    lazyNativeImages.forEach(img => {
      this.addImagePlaceholder(img);
    });
  }
  
  setupComponentLazyLoading() {
    if (!this.options.enableComponents) return;
    
    // Find all components with data-lazy-component attribute
    const lazyComponents = document.querySelectorAll('[data-lazy-component]');
    
    lazyComponents.forEach(component => {
      // Add loading skeleton
      this.addComponentSkeleton(component);
      
      // Start observing
      this.componentObserver.observe(component);
    });
  }
  
  setupChartLazyLoading() {
    if (!this.options.enableCharts) return;
    
    // Find all chart containers
    const chartContainers = document.querySelectorAll('[data-chart], .chart-container');
    
    chartContainers.forEach(chart => {
      // Add chart skeleton
      this.addChartSkeleton(chart);
      
      // Start observing
      this.observer.observe(chart);
    });
  }
  
  setupIframeLazyLoading() {
    if (!this.options.enableIframes) return;
    
    // Find all iframes with data-src attribute
    const lazyIframes = document.querySelectorAll('iframe[data-src]');
    
    lazyIframes.forEach(iframe => {
      // Add iframe placeholder
      this.addIframePlaceholder(iframe);
      
      // Start observing
      this.observer.observe(iframe);
    });
  }
  
  setupIntersectionObserver() {
    // Observe elements with general lazy loading attributes
    const lazyElements = document.querySelectorAll('[data-lazy]');
    lazyElements.forEach(element => {
      this.observer.observe(element);
    });
  }
  
  handleIntersection(entry) {
    const element = entry.target;
    
    if (this.loadedElements.has(element)) return;
    
    const lazyType = element.dataset.lazy;
    
    switch (lazyType) {
      case 'chart':
        this.loadChart(element);
        break;
      case 'iframe':
        this.loadIframe(element);
        break;
      case 'component':
        this.loadComponent(element);
        break;
      default:
        this.loadGeneric(element);
    }
    
    // Stop observing this element
    this.observer.unobserve(element);
    this.loadedElements.add(element);
  }
  
  loadImage(img) {
    if (this.loadedElements.has(img)) return;
    
    const src = img.dataset.src;
    if (!src) return;
    
    // Create new image to test if it loads
    const imageLoader = new Image();
    
    imageLoader.onload = () => {
      // Replace src and remove placeholder
      img.src = src;
      img.classList.remove('lazy-loading');
      img.classList.add('lazy-loaded');
      
      // Remove placeholder if it exists
      const placeholder = img.parentNode.querySelector('.lazy-placeholder');
      if (placeholder) {
        placeholder.remove();
      }
      
      this.loadedElements.add(img);
      this.imageObserver.unobserve(img);
    };
    
    imageLoader.onerror = () => {
      // Handle image load error
      img.classList.remove('lazy-loading');
      img.classList.add('lazy-error');
      
      const placeholder = img.parentNode.querySelector('.lazy-placeholder');
      if (placeholder) {
        placeholder.textContent = 'Failed to load image';
        placeholder.classList.add('lazy-error');
      }
      
      this.loadedElements.add(img);
      this.imageObserver.unobserve(img);
    };
    
    imageLoader.src = src;
  }
  
  loadComponent(component) {
    if (this.loadedElements.has(component)) return;
    
    const componentType = component.dataset.lazyComponent;
    const componentData = component.dataset.lazyData;
    
    // Remove skeleton
    const skeleton = component.querySelector('.lazy-skeleton');
    if (skeleton) {
      skeleton.remove();
    }
    
    // Load component based on type
    switch (componentType) {
      case 'chart':
        this.loadChart(component);
        break;
      case 'table':
        this.loadTable(component);
        break;
      case 'form':
        this.loadForm(component);
        break;
      case 'list':
        this.loadList(component);
        break;
      default:
        this.loadGenericComponent(component);
    }
    
    component.classList.remove('lazy-loading');
    component.classList.add('lazy-loaded');
    this.loadedElements.add(component);
    this.componentObserver.unobserve(component);
  }
  
  loadChart(chartElement) {
    // Load Chart.js if not already loaded
    if (typeof Chart === 'undefined') {
      this.loadScript('https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js')
        .then(() => {
          this.initializeChart(chartElement);
        });
    } else {
      this.initializeChart(chartElement);
    }
  }
  
  initializeChart(chartElement) {
    const chartData = JSON.parse(chartElement.dataset.chartData || '{}');
    const chartOptions = JSON.parse(chartElement.dataset.chartOptions || '{}');
    
    if (chartData && Object.keys(chartData).length > 0) {
      const ctx = chartElement.getContext ? chartElement : chartElement.querySelector('canvas');
      if (ctx) {
        new Chart(ctx, {
          type: chartData.type || 'bar',
          data: chartData.data || {},
          options: chartOptions
        });
      }
    }
  }
  
  loadIframe(iframe) {
    const src = iframe.dataset.src;
    if (!src) return;
    
    iframe.src = src;
    iframe.classList.remove('lazy-loading');
    iframe.classList.add('lazy-loaded');
    
    // Remove placeholder
    const placeholder = iframe.parentNode.querySelector('.lazy-placeholder');
    if (placeholder) {
      placeholder.remove();
    }
  }
  
  loadTable(tableElement) {
    // Simulate table loading
    tableElement.classList.remove('lazy-loading');
    tableElement.classList.add('lazy-loaded');
  }
  
  loadForm(formElement) {
    // Simulate form loading
    formElement.classList.remove('lazy-loading');
    formElement.classList.add('lazy-loaded');
  }
  
  loadList(listElement) {
    // Simulate list loading
    listElement.classList.remove('lazy-loading');
    listElement.classList.add('lazy-loaded');
  }
  
  loadGeneric(element) {
    element.classList.remove('lazy-loading');
    element.classList.add('lazy-loaded');
  }
  
  loadGenericComponent(component) {
    component.classList.remove('lazy-loading');
    component.classList.add('lazy-loaded');
  }
  
  addImagePlaceholder(img) {
    img.classList.add('lazy-loading');
    
    // Create placeholder div
    const placeholder = document.createElement('div');
    placeholder.className = 'lazy-placeholder';
    placeholder.innerHTML = `
      <div class="skeleton skeleton-image">
        <svg class="skeleton-icon" viewBox="0 0 24 24">
          <path fill="currentColor" d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
        </svg>
      </div>
    `;
    
    // Insert placeholder before image
    img.parentNode.insertBefore(placeholder, img);
  }
  
  addComponentSkeleton(component) {
    component.classList.add('lazy-loading');
    
    const skeleton = document.createElement('div');
    skeleton.className = 'lazy-skeleton';
    skeleton.innerHTML = `
      <div class="skeleton skeleton-component">
        <div class="skeleton-line"></div>
        <div class="skeleton-line"></div>
        <div class="skeleton-line skeleton-line--short"></div>
      </div>
    `;
    
    component.appendChild(skeleton);
  }
  
  addChartSkeleton(chart) {
    chart.classList.add('lazy-loading');
    
    const skeleton = document.createElement('div');
    skeleton.className = 'lazy-skeleton skeleton-chart';
    skeleton.innerHTML = `
      <div class="skeleton skeleton-chart-content">
        <div class="skeleton-bars">
          <div class="skeleton-bar" style="height: 60%"></div>
          <div class="skeleton-bar" style="height: 80%"></div>
          <div class="skeleton-bar" style="height: 45%"></div>
          <div class="skeleton-bar" style="height: 90%"></div>
          <div class="skeleton-bar" style="height: 70%"></div>
        </div>
      </div>
    `;
    
    chart.appendChild(skeleton);
  }
  
  addIframePlaceholder(iframe) {
    iframe.classList.add('lazy-loading');
    
    const placeholder = document.createElement('div');
    placeholder.className = 'lazy-placeholder lazy-iframe-placeholder';
    placeholder.innerHTML = `
      <div class="skeleton skeleton-iframe">
        <svg class="skeleton-icon" viewBox="0 0 24 24">
          <path fill="currentColor" d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm0 2v12h16V6H4zm2 2h12v2H6V8zm0 4h12v2H6v-2z"/>
        </svg>
      </div>
    `;
    
    iframe.parentNode.insertBefore(placeholder, iframe);
  }
  
  loadScript(src) {
    return new Promise((resolve, reject) => {
      const script = document.createElement('script');
      script.src = src;
      script.onload = resolve;
      script.onerror = reject;
      document.head.appendChild(script);
    });
  }
  
  // Public methods
  observe(element) {
    this.observer.observe(element);
  }
  
  unobserve(element) {
    this.observer.unobserve(element);
  }
  
  disconnect() {
    this.observer.disconnect();
    if (this.imageObserver) this.imageObserver.disconnect();
    if (this.componentObserver) this.componentObserver.disconnect();
  }
  
  // Refresh lazy loading for dynamically added content
  refresh() {
    this.setupImageLazyLoading();
    this.setupComponentLazyLoading();
    this.setupChartLazyLoading();
    this.setupIframeLazyLoading();
    this.setupIntersectionObserver();
  }
}

// Initialize lazy loading system when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  window.lazyLoadingSystem = new LazyLoadingSystem();
});

// Export for use in other modules
window.LazyLoadingSystem = LazyLoadingSystem;
