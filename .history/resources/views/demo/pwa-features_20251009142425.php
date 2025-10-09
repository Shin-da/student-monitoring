<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWA Features Demo - Smart Student Monitoring System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('app.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('assets/pwa-styles.css') ?>" rel="stylesheet">
    <link rel="manifest" href="<?= \Helpers\Url::publicPath('manifest.json') ?>">
    <style>
        .demo-section {
            margin-bottom: 3rem;
            padding: 2rem;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            background: white;
        }
        
        .feature-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .pwa-status {
            position: sticky;
            top: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body class="bg-light">
        <script>
            window.__BASE_PATH__ = <?= json_encode(\Helpers\Url::basePath()) ?>;
        </script>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold text-primary">PWA Features Demo</h1>
                    <p class="lead text-muted">Experience the Progressive Web App capabilities of the Smart Student Monitoring System</p>
                </div>

                <!-- PWA Status -->
                <div class="demo-section">
                    <h3 class="mb-4">📱 PWA Status</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">App Installation</h5>
                                    <p class="card-text">Check if the app can be installed on your device</p>
                                    <button class="btn btn-primary" onclick="checkInstallability()">
                                        Check Installability
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Connection Status</h5>
                                    <p class="card-text">Monitor your online/offline status</p>
                                    <div id="connectionStatus" class="badge bg-secondary">Checking...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offline Features -->
                <div class="demo-section">
                    <h3 class="mb-4">🔌 Offline Capabilities</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <div class="display-4 mb-3">📚</div>
                                    <h5 class="card-title">Cached Content</h5>
                                    <p class="card-text">Access previously viewed pages and data while offline</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <div class="display-4 mb-3">💾</div>
                                    <h5 class="card-title">Data Sync</h5>
                                    <p class="card-text">Changes made offline will sync when connection is restored</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <div class="display-4 mb-3">⚡</div>
                                    <h5 class="card-title">Fast Loading</h5>
                                    <p class="card-text">Instant loading from cache for better performance</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Push Notifications -->
                <div class="demo-section">
                    <h3 class="mb-4">🔔 Push Notifications</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Permission Status</h5>
                                    <p class="card-text">Check notification permission status</p>
                                    <div id="notificationStatus" class="badge bg-secondary">Checking...</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Test Notification</h5>
                                    <p class="card-text">Send a test notification</p>
                                    <button class="btn btn-primary" onclick="testNotification()">
                                        Send Test Notification
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- App Features -->
                <div class="demo-section">
                    <h3 class="mb-4">🚀 App Features</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">App Shortcuts</h5>
                                    <p class="card-text">Quick access to common features</p>
                                    <ul class="list-unstyled">
                                        <li>📊 Dashboard</li>
                                        <li>📈 Grades</li>
                                        <li>📅 Attendance</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Responsive Design</h5>
                                    <p class="card-text">Optimized for all screen sizes</p>
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-primary">Desktop</span>
                                        <span class="badge bg-success">Tablet</span>
                                        <span class="badge bg-info">Mobile</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testing Tools -->
                <div class="demo-section">
                    <h3 class="mb-4">🧪 Testing Tools</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-outline-primary w-100 mb-3" onclick="simulateOffline()">
                                Simulate Offline
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-success w-100 mb-3" onclick="simulateOnline()">
                                Simulate Online
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-warning w-100 mb-3" onclick="clearCache()">
                                Clear Cache
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="pwa-status">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">PWA Information</h5>
                        </div>
                        <div class="card-body">
                            <div id="pwaInfo">
                                <div class="mb-3">
                                    <strong>Service Worker:</strong>
                                    <span id="swStatus" class="badge bg-secondary">Checking...</span>
                                </div>
                                <div class="mb-3">
                                    <strong>App Installed:</strong>
                                    <span id="appInstalled" class="badge bg-secondary">Checking...</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Connection:</strong>
                                    <span id="connectionInfo" class="badge bg-secondary">Checking...</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Notifications:</strong>
                                    <span id="notificationsInfo" class="badge bg-secondary">Checking...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary w-100 mb-2" onclick="installApp()">
                                Install App
                            </button>
                            <button class="btn btn-outline-primary w-100 mb-2" onclick="openAppInfo()">
                                App Information
                            </button>
                            <button class="btn btn-outline-secondary w-100" onclick="refreshStatus()">
                                Refresh Status
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= \Helpers\Url::asset('assets/pwa-manager.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize PWA demo
        document.addEventListener('DOMContentLoaded', function() {
            updatePWAStatus();
            updateConnectionStatus();
            updateNotificationStatus();
            
            // Update status every 5 seconds
            setInterval(updatePWAStatus, 5000);
        });

        // Update PWA status
        function updatePWAStatus() {
            const swStatus = document.getElementById('swStatus');
            const appInstalled = document.getElementById('appInstalled');
            
            if ('serviceWorker' in navigator) {
                swStatus.textContent = 'Supported';
                swStatus.className = 'badge bg-success';
            } else {
                swStatus.textContent = 'Not Supported';
                swStatus.className = 'badge bg-danger';
            }
            
            if (window.matchMedia('(display-mode: standalone)').matches || 
                window.navigator.standalone === true) {
                appInstalled.textContent = 'Yes';
                appInstalled.className = 'badge bg-success';
            } else {
                appInstalled.textContent = 'No';
                appInstalled.className = 'badge bg-warning';
            }
        }

        // Update connection status
        function updateConnectionStatus() {
            const connectionStatus = document.getElementById('connectionStatus');
            const connectionInfo = document.getElementById('connectionInfo');
            
            if (navigator.onLine) {
                connectionStatus.textContent = 'Online';
                connectionStatus.className = 'badge bg-success';
                connectionInfo.textContent = 'Connected';
                connectionInfo.className = 'badge bg-success';
            } else {
                connectionStatus.textContent = 'Offline';
                connectionStatus.className = 'badge bg-danger';
                connectionInfo.textContent = 'Disconnected';
                connectionInfo.className = 'badge bg-danger';
            }
        }

        // Update notification status
        function updateNotificationStatus() {
            const notificationsInfo = document.getElementById('notificationsInfo');
            
            if ('Notification' in window) {
                switch (Notification.permission) {
                    case 'granted':
                        notificationsInfo.textContent = 'Granted';
                        notificationsInfo.className = 'badge bg-success';
                        break;
                    case 'denied':
                        notificationsInfo.textContent = 'Denied';
                        notificationsInfo.className = 'badge bg-danger';
                        break;
                    default:
                        notificationsInfo.textContent = 'Not Requested';
                        notificationsInfo.className = 'badge bg-warning';
                }
            } else {
                notificationsInfo.textContent = 'Not Supported';
                notificationsInfo.className = 'badge bg-secondary';
            }
        }

        // Check installability
        function checkInstallability() {
            if (window.pwaManager && window.pwaManager.deferredPrompt) {
                alert('✅ This app can be installed! Click the "Install App" button.');
            } else {
                alert('ℹ️ Install prompt not available. This might be because:\n- App is already installed\n- Browser doesn\'t support PWA installation\n- App doesn\'t meet installation criteria');
            }
        }

        // Install app
        function installApp() {
            if (window.pwaManager) {
                window.pwaManager.installApp();
            } else {
                alert('PWA Manager not available');
            }
        }

        // Test notification
        function testNotification() {
            if ('Notification' in window) {
                if (Notification.permission === 'granted') {
                    new Notification('SSMS Test', {
                        body: 'This is a test notification from the Smart Student Monitoring System',
                        icon: '/assets/icons/icon-192x192.png',
                        tag: 'test-notification'
                    });
                } else if (Notification.permission === 'default') {
                    Notification.requestPermission().then(permission => {
                        if (permission === 'granted') {
                            testNotification();
                        }
                    });
                } else {
                    alert('Notification permission denied. Please enable notifications in your browser settings.');
                }
            } else {
                alert('Notifications not supported in this browser');
            }
        }

        // Simulate offline
        function simulateOffline() {
            // This is a demo function - in real implementation, you'd use service worker
            alert('Offline simulation: In a real PWA, the service worker would handle offline functionality');
        }

        // Simulate online
        function simulateOnline() {
            alert('Online simulation: Connection restored, data would sync automatically');
        }

        // Clear cache
        function clearCache() {
            if ('caches' in window) {
                caches.keys().then(cacheNames => {
                    cacheNames.forEach(cacheName => {
                        caches.delete(cacheName);
                    });
                    alert('Cache cleared successfully');
                });
            } else {
                alert('Cache API not supported');
            }
        }

        // Open app info
        function openAppInfo() {
            if (window.pwaManager) {
                const info = window.pwaManager.getAppInfo();
                alert(`PWA Information:
                \nInstalled: ${info.isInstalled}
                \nOnline: ${info.isOnline}
                \nService Worker: ${info.hasServiceWorker}
                \nNotifications: ${info.hasNotifications}
                \nPush Manager: ${info.hasPushManager}
                \nPlatform: ${info.platform}`);
            }
        }

        // Refresh status
        function refreshStatus() {
            updatePWAStatus();
            updateConnectionStatus();
            updateNotificationStatus();
        }

        // Listen for online/offline events
        window.addEventListener('online', updateConnectionStatus);
        window.addEventListener('offline', updateConnectionStatus);
    </script>
</body>
</html>
