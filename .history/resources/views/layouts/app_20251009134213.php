<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Smart Student Monitoring - enterprise-grade web system for schools.">
    <meta name="theme-color" content="#0d6efd">
    <title><?= htmlspecialchars($title ?? 'Smart Student Monitoring') ?></title>
    <?php $base = \Helpers\Url::basePath(); ?>
  <link rel="icon" type="image/svg+xml" href="<?= \Helpers\Url::asset('assets/favicon.svg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('app.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('assets/enhanced-forms.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('assets/component-library.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('assets/pwa-styles.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('assets/realtime-styles.css') ?>" rel="stylesheet">
    
    <!-- PWA Manifest -->
  <link rel="manifest" href="<?= $base ?>/manifest.json">
    
    <!-- PWA Meta Tags -->
    <meta name="application-name" content="SSMS">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="SSMS">
    <meta name="description" content="Smart Student Monitoring System - Comprehensive educational management platform">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
  <meta name="msapplication-config" content="<?= $base ?>/browserconfig.xml">
    <meta name="msapplication-TileColor" content="#0d6efd">
    <meta name="msapplication-tap-highlight" content="no">
    
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" href="<?= \Helpers\Url::asset('assets/icons/icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= \Helpers\Url::asset('assets/icons/icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= \Helpers\Url::asset('assets/icons/icon-192x192.png') ?>">
    <link rel="apple-touch-icon" sizes="167x167" href="<?= \Helpers\Url::asset('assets/icons/icon-192x192.png') ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= \Helpers\Url::asset('assets/icons/icon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= \Helpers\Url::asset('assets/icons/icon-16x16.png') ?>">
    <link rel="shortcut icon" href="<?= \Helpers\Url::asset('assets/icons/icon-32x32.png') ?>">
    <script>
      (function(){
        try{var p=localStorage.getItem('theme-preference')||'auto';var m=window.matchMedia('(prefers-color-scheme: dark)').matches;var r=p==='auto'?(m?'dark':'light'):p;document.documentElement.setAttribute('data-theme',r==='dark'?'dark':'light');}catch(e){}
      })();
    </script>
    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
      <!-- Theme icons -->
      <symbol id="icon-sun" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 4a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V5a1 1 0 0 1 1-1m0 13a5 5 0 1 1 0-10a5 5 0 0 1 0 10m7-6a1 1 0 0 1 1 1a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2zM6 12a1 1 0 0 1-1 1H4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1m11.66 6.66a1 1 0 0 1-1.41 0l-.71-.7a1 1 0 0 1 1.41-1.42l.71.71a1 1 0 0 1 0 1.41M7.76 7.76a1 1 0 0 1-1.42 0l-.7-.71A1 1 0 0 1 7.05 4.9l.71.71a1 1 0 0 1 0 1.41m8.9-2.85l.71-.71A1 1 0 0 1 19.24 6l-.71.71a1 1 0 0 1-1.41-1.42M5.17 17.17l.71-.71a1 1 0 1 1 1.41 1.41l-.71.71A1 1 0 0 1 5.17 17.17M12 18a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 1 1-1"/>
      </symbol>
      <symbol id="icon-moon" viewBox="0 0 24 24">
        <path fill="currentColor" d="M17.75 19q-2.925 0-4.963-2.037T10.75 12q0-2.725 1.775-4.763T17.25 4q.4 0 .775.05t.725.175q-1.4.875-2.225 2.362T15.75 10q0 1.95.825 3.413t2.225 2.362q-.35.125-.725.175t-.325.05"/>
      </symbol>
      
      <!-- Role icons -->
      <symbol id="icon-admin" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
      </symbol>
      <symbol id="icon-teacher" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22L12 18.77L5.82 22L7 14.14L2 9.27l6.91-1.01L12 2z"/>
      </symbol>
      <symbol id="icon-adviser" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93c0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41c0 2.08-.8 3.97-2.1 5.39z"/>
      </symbol>
      <symbol id="icon-student" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
      </symbol>
      <symbol id="icon-parent" viewBox="0 0 24 24">
        <path fill="currentColor" d="M16 4c0-1.11.89-2 2-2s2 .89 2 2s-.89 2-2 2s-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H17c-.8 0-1.54.37-2.01.99L14 10.5l-1.5-2c-.47-.62-1.21-.99-2.01-.99H9.46c-.8 0-1.54.37-2.01.99L4.5 14.37L2 16v6h2v-4h2v4h2v-4h2v4h2v-4h2v4h2z"/>
      </symbol>
      
      <!-- Navigation icons -->
      <symbol id="icon-home" viewBox="0 0 24 24">
        <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/>
      </symbol>
      <symbol id="icon-dashboard" viewBox="0 0 24 24">
        <path fill="currentColor" d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
      </symbol>
      <symbol id="icon-sections" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
      </symbol>
      <symbol id="icon-performance" viewBox="0 0 24 24">
        <path fill="currentColor" d="M16 6l2.29 2.29l-4.88 4.88l-4-4L2 16.59L3.41 18l6-6l4 4l6.3-6.29L22 12V6z"/>
      </symbol>
      <symbol id="icon-alerts" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
      </symbol>
      <symbol id="icon-students" viewBox="0 0 24 24">
        <path fill="currentColor" d="M16 4c0-1.11.89-2 2-2s2 .89 2 2s-.89 2-2 2s-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H17c-.8 0-1.54.37-2.01.99L14 10.5l-1.5-2c-.47-.62-1.21-.99-2.01-.99H9.46c-.8 0-1.54.37-2.01.99L4.5 14.37L2 16v6h2v-4h2v4h2v-4h2v4h2v-4h2v4h2z"/>
      </symbol>
      <symbol id="icon-teachers" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22L12 18.77L5.82 22L7 14.14L2 9.27l6.91-1.01L12 2z"/>
      </symbol>
      <symbol id="icon-subjects" viewBox="0 0 24 24">
        <path fill="currentColor" d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
      </symbol>
      <symbol id="icon-sections-admin" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
      </symbol>
      <symbol id="icon-logout" viewBox="0 0 24 24">
        <path fill="currentColor" d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
      </symbol>
      
      <!-- Action icons -->
      <symbol id="icon-lock" viewBox="0 0 24 24">
        <path fill="currentColor" d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1s3.1 1.39 3.1 3.1v2z"/>
      </symbol>
      <symbol id="icon-star" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2L9.19 8.63L2 9.24l5.46 4.73L5.82 21z"/>
      </symbol>
      <symbol id="icon-chart" viewBox="0 0 24 24">
        <path fill="currentColor" d="M5 9.2h3V19H5zM10.6 5h2.8v14h-2.8zm5.6 8H19v6h-2.8z"/>
      </symbol>
      <symbol id="icon-plus" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
      </symbol>
      <symbol id="icon-user" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
      </symbol>
      <symbol id="icon-report" viewBox="0 0 24 24">
        <path fill="currentColor" d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
      </symbol>
    </svg>
</head>
<body class="app-container">
<nav class="navbar navbar-expand-lg navbar-dark navbar-glass sticky-top" data-nav>
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="<?= $base ?>/">SSM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php $path = $_SERVER['REQUEST_URI'] ?? '/'; ?>
                <li class="nav-item"><a class="nav-link <?= $path===$base.'/' ? 'active' : '' ?>" href="<?= $base ?>/">Home</a></li>
                <li class="nav-item"><a class="nav-link <?= str_starts_with($path, $base.'/admin') ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/admin') ?>">Admin</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-light theme-toggle" type="button" data-theme-toggle aria-label="Toggle theme" title="Theme: Light / Dark / Auto">
                    <svg class="icon" aria-hidden="true"><use data-theme-icon href="#icon-sun"></use></svg>
                </button>
                <?php 
                $user = \Core\Session::get('user');
                if ($user): 
                    $userName = $user['name'] ?? 'User';
                    $userRole = $user['role'] ?? 'user';
                    $roleIconIds = [
                        'admin' => 'icon-admin',
                        'teacher' => 'icon-teacher', 
                        'adviser' => 'icon-adviser',
                        'student' => 'icon-student',
                        'parent' => 'icon-parent'
                    ];
                    $roleIconId = $roleIconIds[$userRole] ?? 'icon-user';
                ?>
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg class="user-avatar" width="20" height="20" fill="currentColor">
                            <use href="#<?= $roleIconId ?>"></use>
                        </svg>
                        <span class="d-none d-lg-inline"><?= htmlspecialchars($userName) ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header"><?= htmlspecialchars($userName) ?></h6></li>
                        <li><span class="dropdown-item-text text-muted small"><?= ucfirst($userRole) ?></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= \Helpers\Url::to('/'.$userRole) ?>">Dashboard</a></li>
                        <li><a class="dropdown-item" href="<?= \Helpers\Url::to('/profile') ?>">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="post" action="<?= \Helpers\Url::to('/logout') ?>" class="d-inline">
                                <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
                                <button class="dropdown-item text-danger" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <?php else: ?>
                <a class="btn btn-outline-light d-none d-lg-inline-flex" href="<?= \Helpers\Url::to('/login') ?>">Login</a>
                <a class="btn btn-primary d-none d-lg-inline-flex" href="<?= \Helpers\Url::to('/register') ?>">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </nav>
<main class="container app-main py-4">
    <?= $content ?? '' ?>
</main>
<footer class="py-4 border-top mt-auto">
    <div class="container-fluid container-narrow d-flex flex-wrap justify-content-between align-items-center gap-2">
        <span class="text-muted small">© <?= date('Y') ?> Smart Student Monitoring</span>
        <div class="d-flex gap-3 small">
            <a class="text-muted text-decoration-none" href="<?= \Helpers\Url::to('/login') ?>">Login</a>
            <a class="text-muted text-decoration-none" href="<?= \Helpers\Url::to('/register') ?>">Register</a>
        </div>
    </div>
</footer>
 <script>
   window.__BASE_PATH__ = <?= json_encode($base) ?>;
 </script>
 <script src="<?= \Helpers\Url::asset('app.js') ?>"></script>
 <script src="<?= \Helpers\Url::asset('assets/enhanced-forms.js') ?>"></script>
 <script src="<?= \Helpers\Url::asset('assets/component-library.js') ?>"></script>
 <script src="<?= \Helpers\Url::asset('assets/pwa-manager.js') ?>"></script>
 <script src="<?= \Helpers\Url::asset('assets/realtime-manager.js') ?>"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


