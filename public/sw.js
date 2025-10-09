/**
 * Service Worker for Smart Student Monitoring System
 * Provides offline functionality, caching, and background sync
 * Enhanced with performance optimizations and cache strategies
 */

const CACHE_VERSION = 'v1.0.2';
const CACHE_NAME = `ssms-${CACHE_VERSION}`;
const STATIC_CACHE = `ssms-static-${CACHE_VERSION}`;
const DYNAMIC_CACHE = `ssms-dynamic-${CACHE_VERSION}`;
const API_CACHE = `ssms-api-${CACHE_VERSION}`;
const IMAGE_CACHE = `ssms-images-${CACHE_VERSION}`;

// Cache TTL (Time To Live) in milliseconds
const CACHE_TTL = {
  static: 7 * 24 * 60 * 60 * 1000, // 7 days
  dynamic: 24 * 60 * 60 * 1000,     // 1 day
  api: 5 * 60 * 1000,               // 5 minutes
  images: 30 * 24 * 60 * 60 * 1000  // 30 days
};

// Determine base path from registration scope (supports subfolder deployments)
const SCOPE_URL = new URL(self.registration.scope);
const BASE_PATH = SCOPE_URL.pathname.replace(/\/$/, ''); // e.g., '' or '/student-monitoring'

// Files to cache immediately (updated for performance)
const withBase = (p) => `${BASE_PATH}${p}`;
const STATIC_ASSETS = [
  withBase('/'),
  withBase('/login'),
  withBase('/register'),
  withBase('/offline.html'),
  withBase('/assets/app.css'),
  withBase('/assets/app.js'),
  withBase('/assets/accessibility.css'),
  withBase('/assets/accessibility.js'),
  withBase('/assets/performance.css'),
  withBase('/assets/performance.js'),
  withBase('/assets/sidebar-complete.css'),
  withBase('/assets/sidebar-complete.js'),
  withBase('/assets/enhanced-forms.css'),
  withBase('/assets/enhanced-forms.js'),
  withBase('/assets/component-library.css'),
  withBase('/assets/component-library.js'),
  withBase('/assets/notification-system.js'),
  withBase('/manifest.json'),
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
  'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js'
];

// API endpoints to cache
const API_ENDPOINTS = [
  withBase('/api/user/profile'),
  withBase('/api/dashboard/stats'),
  withBase('/api/grades/summary'),
  withBase('/api/attendance/summary')
];

// Install event - cache static assets
self.addEventListener('install', (event) => {
  console.log('[SW] Installing service worker...');
  
  event.waitUntil(
    Promise.all([
      caches.open(STATIC_CACHE).then((cache) => {
        console.log('[SW] Caching static assets...');
        return cache.addAll(STATIC_ASSETS);
      }),
      self.skipWaiting()
    ])
  );
});

// Activate event - clean up old caches
self.addEventListener('activate', (event) => {
  console.log('[SW] Activating service worker...');
  
  event.waitUntil(
    Promise.all([
      caches.keys().then((cacheNames) => {
        return Promise.all(
          cacheNames.map((cacheName) => {
            if (cacheName !== STATIC_CACHE && 
                cacheName !== DYNAMIC_CACHE && 
                cacheName !== API_CACHE) {
              console.log('[SW] Deleting old cache:', cacheName);
              return caches.delete(cacheName);
            }
          })
        );
      }),
      self.clients.claim()
    ])
  );
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', (event) => {
  const { request } = event;
  const url = new URL(request.url);
  
  // Skip non-GET requests
  if (request.method !== 'GET') {
    return;
  }
  
  // Skip chrome-extension and other non-http requests
  if (!url.protocol.startsWith('http')) {
    return;
  }
  
  event.respondWith(handleRequest(request));
});

// Handle different types of requests
async function handleRequest(request) {
  const url = new URL(request.url);
  
  try {
    // API requests - cache with network-first strategy
    if (url.pathname.startsWith('/api/')) {
      return await handleApiRequest(request);
    }
    
    // Static assets - cache-first strategy
    if (isStaticAsset(request)) {
      return await handleStaticRequest(request);
    }
    
    // HTML pages - network-first with cache fallback
    if (request.headers.get('accept').includes('text/html')) {
      return await handleHtmlRequest(request);
    }
    
    // Other requests - network-first
    return await fetch(request);
    
  } catch (error) {
    console.error('[SW] Fetch error:', error);
    return await handleOfflineFallback(request);
  }
}

// Handle API requests with network-first strategy
async function handleApiRequest(request) {
  const cache = await caches.open(API_CACHE);
  
  try {
    // Try network first
    const networkResponse = await fetch(request);
    
    if (networkResponse.ok) {
      // Cache successful responses
      cache.put(request, networkResponse.clone());
    }
    
    return networkResponse;
  } catch (error) {
    // Fallback to cache
    const cachedResponse = await cache.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }
    
    // Return offline response for API
    return new Response(
      JSON.stringify({
        error: 'Offline',
        message: 'You are currently offline. Some features may be limited.',
        offline: true
      }),
      {
        status: 503,
        headers: { 'Content-Type': 'application/json' }
      }
    );
  }
}

// Handle static assets with cache-first strategy
async function handleStaticRequest(request) {
  const cache = await caches.open(STATIC_CACHE);
  const cachedResponse = await cache.match(request);
  
  if (cachedResponse) {
    return cachedResponse;
  }
  
  try {
    const networkResponse = await fetch(request);
    if (networkResponse.ok) {
      cache.put(request, networkResponse.clone());
    }
    return networkResponse;
  } catch (error) {
    // Return offline page for static assets
    return new Response('Offline - Static asset not available', {
      status: 503,
      headers: { 'Content-Type': 'text/plain' }
    });
  }
}

// Handle HTML requests with network-first strategy
async function handleHtmlRequest(request) {
  const cache = await caches.open(DYNAMIC_CACHE);
  
  try {
    const networkResponse = await fetch(request);
    
    if (networkResponse.ok) {
      cache.put(request, networkResponse.clone());
    }
    
    return networkResponse;
  } catch (error) {
    // Fallback to cache
    const cachedResponse = await cache.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }
    
    // Return offline page
    return await getOfflinePage();
  }
}

// Check if request is for static asset
function isStaticAsset(request) {
  const url = new URL(request.url);
  return url.pathname.startsWith('/assets/') ||
         url.pathname.endsWith('.css') ||
         url.pathname.endsWith('.js') ||
         url.pathname.endsWith('.png') ||
         url.pathname.endsWith('.jpg') ||
         url.pathname.endsWith('.svg') ||
         url.pathname.endsWith('.ico');
}

// Get offline page
async function getOfflinePage() {
  const cache = await caches.open(STATIC_CACHE);
  const offlinePage = await cache.match(withBase('/offline.html'));
  
  if (offlinePage) {
    return offlinePage;
  }
  
  // Return basic offline page
  return new Response(`
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Offline - SSMS</title>
      <style>
        body { 
          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
          margin: 0; padding: 20px; background: #f8f9fa;
          display: flex; align-items: center; justify-content: center;
          min-height: 100vh; text-align: center;
        }
        .offline-container { max-width: 400px; }
        .offline-icon { font-size: 4rem; color: #6c757d; margin-bottom: 1rem; }
        h1 { color: #495057; margin-bottom: 1rem; }
        p { color: #6c757d; margin-bottom: 2rem; }
        .retry-btn {
          background: #0d6efd; color: white; border: none;
          padding: 12px 24px; border-radius: 6px; cursor: pointer;
          font-size: 16px; transition: background 0.2s;
        }
        .retry-btn:hover { background: #0b5ed7; }
      </style>
    </head>
    <body>
      <div class="offline-container">
        <div class="offline-icon">📱</div>
        <h1>You're Offline</h1>
        <p>It looks like you're not connected to the internet. Some features may be limited while offline.</p>
        <button class="retry-btn" onclick="window.location.reload()">
          Try Again
        </button>
      </div>
    </body>
    </html>
  `, {
    headers: { 'Content-Type': 'text/html' }
  });
}

// Handle offline fallback
async function handleOfflineFallback(request) {
  const url = new URL(request.url);
  
  // Return appropriate offline response based on request type
  if (url.pathname.startsWith('/api/')) {
    return new Response(
      JSON.stringify({
        error: 'Offline',
        message: 'You are currently offline. Please check your connection.',
        offline: true
      }),
      {
        status: 503,
        headers: { 'Content-Type': 'application/json' }
      }
    );
  }
  
  return await getOfflinePage();
}

// Background sync for offline actions
self.addEventListener('sync', (event) => {
  console.log('[SW] Background sync triggered:', event.tag);
  
  if (event.tag === 'grade-sync') {
    event.waitUntil(syncGrades());
  } else if (event.tag === 'attendance-sync') {
    event.waitUntil(syncAttendance());
  }
});

// Sync grades when back online
async function syncGrades() {
  try {
    const pendingGrades = await getPendingGrades();
    
    for (const grade of pendingGrades) {
      try {
  await fetch(withBase('/api/grades'), {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(grade)
        });
        
        // Remove from pending
        await removePendingGrade(grade.id);
      } catch (error) {
        console.error('[SW] Failed to sync grade:', error);
      }
    }
  } catch (error) {
    console.error('[SW] Grade sync error:', error);
  }
}

// Sync attendance when back online
async function syncAttendance() {
  try {
    const pendingAttendance = await getPendingAttendance();
    
    for (const record of pendingAttendance) {
      try {
  await fetch(withBase('/api/attendance'), {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(record)
        });
        
        // Remove from pending
        await removePendingAttendance(record.id);
      } catch (error) {
        console.error('[SW] Failed to sync attendance:', error);
      }
    }
  } catch (error) {
    console.error('[SW] Attendance sync error:', error);
  }
}

// Helper functions for offline data management
async function getPendingGrades() {
  // This would typically read from IndexedDB
  return [];
}

async function getPendingAttendance() {
  // This would typically read from IndexedDB
  return [];
}

async function removePendingGrade(id) {
  // This would typically remove from IndexedDB
  console.log('[SW] Removed pending grade:', id);
}

async function removePendingAttendance(id) {
  // This would typically remove from IndexedDB
  console.log('[SW] Removed pending attendance:', id);
}

// Push notification handling
self.addEventListener('push', (event) => {
  console.log('[SW] Push notification received:', event);
  
  const options = {
    body: event.data ? event.data.text() : 'New notification from SSMS',
    icon: '/assets/icons/icon-192x192.png',
    badge: '/assets/icons/badge-72x72.png',
    vibrate: [200, 100, 200],
    data: {
      url: withBase('/dashboard')
    },
    actions: [
      {
        action: 'open',
        title: 'Open',
        icon: withBase('/assets/icons/action-open.png')
      },
      {
        action: 'dismiss',
        title: 'Dismiss',
        icon: withBase('/assets/icons/action-dismiss.png')
      }
    ]
  };
  
  event.waitUntil(
    self.registration.showNotification('SSMS Notification', options)
  );
});

// Notification click handling
self.addEventListener('notificationclick', (event) => {
  console.log('[SW] Notification clicked:', event);
  
  event.notification.close();
  
  if (event.action === 'open') {
    event.waitUntil(
      clients.openWindow(event.notification.data.url || '/')
    );
  }
});

// Message handling from main thread
self.addEventListener('message', (event) => {
  console.log('[SW] Message received:', event.data);
  
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
  
  if (event.data && event.data.type === 'CACHE_URLS') {
    event.waitUntil(
      caches.open(DYNAMIC_CACHE).then((cache) => {
        return cache.addAll(event.data.urls);
      })
    );
  }
});

console.log('[SW] Service worker loaded successfully');
