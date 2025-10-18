<?php
/**
 * Asset Manager for Performance Optimization
 * Handles loading of CSS and JS bundles with proper optimization
 */

namespace App\Helpers;

class AssetManager
{
    private static $instance = null;
    private $basePath;
    private $isProduction;
    private $manifest = null;
    
    public function __construct()
    {
        $this->basePath = \Helpers\Url::basePath();
        $this->isProduction = $this->isProductionEnvironment();
        $this->loadManifest();
    }
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Load critical CSS inline in the head
     */
    public function getCriticalCSS()
    {
        $criticalCSSPath = $this->getAssetPath('critical.min.css');
        if (file_exists($criticalCSSPath)) {
            return file_get_contents($criticalCSSPath);
        }
        return '';
    }
    
    /**
     * Get optimized CSS bundle
     */
    public function getCSSBundle($bundleName = 'app')
    {
        $filename = $this->getAssetFilename($bundleName . '.min.css');
        $path = $this->getAssetPath($filename);
        
        if (file_exists($path)) {
            return \Helpers\Url::asset($filename);
        }
        
        // Fallback to individual files if bundle doesn't exist
        return $this->getFallbackCSS($bundleName);
    }
    
    /**
     * Get optimized JS bundle
     */
    public function getJSBundle($bundleName = 'app')
    {
        $filename = $this->getAssetFilename($bundleName . '.min.js');
        $path = $this->getAssetPath($filename);
        
        if (file_exists($path)) {
            return \Helpers\Url::asset($filename);
        }
        
        // Fallback to individual files if bundle doesn't exist
        return $this->getFallbackJS($bundleName);
    }
    
    /**
     * Load assets with preloading for critical resources
     */
    public function getPreloadLinks()
    {
        $links = [];
        
        // Preload critical CSS
        $criticalCSS = $this->getCSSBundle('critical');
        if ($criticalCSS) {
            $links[] = '<link rel="preload" href="' . $criticalCSS . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
        }
        
        // Preload critical JS
        $criticalJS = $this->getJSBundle('app');
        if ($criticalJS) {
            $links[] = '<link rel="preload" href="' . $criticalJS . '" as="script">';
        }
        
        return implode("\n  ", $links);
    }
    
    /**
     * Load non-critical assets with lazy loading
     */
    public function getLazyAssets()
    {
        $scripts = [];
        
        // Load component library on demand
        $componentsJS = $this->getJSBundle('components');
        if ($componentsJS) {
            $scripts[] = $this->createLazyScript($componentsJS, 'loadComponents');
        }
        
        return implode("\n  ", $scripts);
    }
    
    /**
     * Generate optimized asset loading for layout
     */
    public function renderAssets($pageType = 'app')
    {
        $output = [];
        
        // Critical CSS (inline)
        $criticalCSS = $this->getCriticalCSS();
        if ($criticalCSS) {
            $output[] = '<style>' . $criticalCSS . '</style>';
        }
        
        // Main CSS bundle (includes fallback)
        $cssBundle = $this->getCSSBundle($pageType);
        if ($cssBundle) {
            $output[] = $cssBundle;
        }
        
        // Main JS bundle (includes fallback)
        $jsBundle = $this->getJSBundle($pageType);
        if ($jsBundle) {
            $output[] = $jsBundle;
        }
        
        // Lazy assets
        $lazyAssets = $this->getLazyAssets();
        if ($lazyAssets) {
            $output[] = $lazyAssets;
        }
        
        return implode("\n  ", $output);
    }
    
    private function getAssetFilename($filename)
    {
        if ($this->isProduction && $this->manifest) {
            $key = str_replace('.min.', '.', $filename);
            return $this->manifest[$key] ?? $filename;
        }
        
        return $filename;
    }
    
    private function getAssetPath($filename)
    {
        return $_SERVER['DOCUMENT_ROOT'] . $this->basePath . '/public/assets/' . $filename;
    }
    
    private function loadManifest()
    {
        $manifestPath = $this->getAssetPath('manifest.json');
        if (file_exists($manifestPath)) {
            $this->manifest = json_decode(file_get_contents($manifestPath), true);
        }
    }
    
    private function isProductionEnvironment()
    {
        return !isset($_GET['debug']) && !in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1']);
    }
    
    private function getFallbackCSS($pageType = 'app')
    {
        // Return the main CSS files that exist
        $cssFiles = [
            'app.css',
            'enhanced-forms.css',
            'component-library.css',
            'pwa-styles.css',
            'realtime-styles.css',
            'accessibility.css',
            'performance.css'
        ];
        
        $links = [];
        foreach ($cssFiles as $file) {
            $path = $this->getAssetPath($file);
            if (file_exists($path)) {
                $links[] = '<link rel="stylesheet" href="' . \Helpers\Url::asset($file) . '">';
            }
        }
        
        return implode("\n  ", $links);
    }
    
    private function getFallbackJS($pageType = 'app')
    {
        // Return the main JS files that exist
        $jsFiles = [
            'app.js',
            'enhanced-forms.js',
            'component-library.js',
            'accessibility.js',
            'performance.js',
            'pwa-manager.js',
            'realtime-manager.js'
        ];
        
        $scripts = [];
        foreach ($jsFiles as $file) {
            $path = $this->getAssetPath($file);
            if (file_exists($path)) {
                $scripts[] = '<script src="' . \Helpers\Url::asset($file) . '" defer></script>';
            }
        }
        
        return implode("\n  ", $scripts);
    }
    
    private function createLazyScript($src, $callback = null)
    {
        $script = '<script>';
        $script .= 'if (typeof ' . $callback . ' === "function") { ';
        $script .= $callback . '(); } else { ';
        $script .= 'const script = document.createElement("script"); ';
        $script .= 'script.src = "' . $src . '"; ';
        $script .= 'script.defer = true; ';
        $script .= 'document.head.appendChild(script); ';
        $script .= '}';
        $script .= '</script>';
        
        return $script;
    }
}
