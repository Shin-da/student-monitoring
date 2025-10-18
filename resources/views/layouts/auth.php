<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Smart Student Monitoring - enterprise-grade web system for schools.">
  <meta name="theme-color" content="#c5705d">
  <title><?= htmlspecialchars($title ?? 'Smart Student Monitoring') ?></title>

  <!-- Skip to content link for accessibility -->
  <a href="#main-content" class="skip-link visually-hidden-focusable">Skip to main content</a>
  <?php $base = \Helpers\Url::basePath(); ?>
  <link rel="icon" type="image/svg+xml" href="<?= \Helpers\Url::asset('assets/favicon.svg') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('app.css') ?>" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('assets/enhanced-forms.css') ?>" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('assets/component-library.css') ?>" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('assets/pwa-styles.css') ?>" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('assets/realtime-styles.css') ?>" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('assets/accessibility.css') ?>" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('assets/performance.css') ?>" rel="stylesheet">
  <link href="<?= \Helpers\Url::asset('assets/auth-styles.css') ?>" rel="stylesheet">

  <!-- PWA Manifest -->
  <link rel="manifest" href="<?= \Helpers\Url::publicPath('manifest.json') ?>">

  <!-- PWA Meta Tags -->
  <meta name="application-name" content="SSMS">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-title" content="SSMS">
  <meta name="description" content="Smart Student Monitoring System - Comprehensive educational management platform">
  <meta name="format-detection" content="telephone=no">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="msapplication-config" content="<?= \Helpers\Url::publicPath('browserconfig.xml') ?>">
  <meta name="msapplication-TileColor" content="#c5705d">
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
    window.__BASE_PATH__ = <?= json_encode(\Helpers\Url::basePath()) ?>;
    (function() {
      try {
        var p = localStorage.getItem('theme-preference') || 'auto';
        var m = window.matchMedia('(prefers-color-scheme: dark)').matches;
        var r = p === 'auto' ? (m ? 'dark' : 'light') : p;
        document.documentElement.setAttribute('data-theme', r === 'dark' ? 'dark' : 'light');
      } catch (e) {}
    })();
  </script>
  
  <svg xmlns="http://www.w3.org/2000/svg" style="display:none" aria-hidden="true">
    <!-- Theme icons -->
    <symbol id="icon-sun" viewBox="0 0 24 24">
      <path fill="currentColor" d="M12 4a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V5a1 1 0 0 1 1-1m0 13a5 5 0 1 1 0-10a5 5 0 0 1 0 10m7-6a1 1 0 0 1 1 1a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2zM6 12a1 1 0 0 1-1 1H4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1m11.66 6.66a1 1 0 0 1-1.41 0l-.71-.7a1 1 0 0 1 1.41-1.42l.71.71a1 1 0 0 1 0 1.41M7.76 7.76a1 1 0 0 1-1.42 0l-.7-.71A1 1 0 0 1 7.05 4.9l.71.71a1 1 0 0 1 0 1.41m8.9-2.85l.71-.71A1 1 0 0 1 19.24 6l-.71.71a1 1 0 0 1-1.41-1.42M5.17 17.17l.71-.71a1 1 0 1 1 1.41 1.41l-.71.71A1 1 0 0 1 5.17 17.17M12 18a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 1 1-1" />
    </symbol>
    <symbol id="icon-moon" viewBox="0 0 24 24">
      <path fill="currentColor" d="M17.75 19q-2.925 0-4.963-2.037T10.75 12q0-2.725 1.775-4.763T17.25 4q.4 0 .775.05t.725.175q-1.4.875-2.225 2.362T15.75 10q0 1.95.825 3.413t2.225 2.362q-.35.125-.725.175t-.325.05" />
    </symbol>

    <!-- Auth icons -->
    <symbol id="icon-lock" viewBox="0 0 24 24">
      <path fill="currentColor" d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1s3.1 1.39 3.1 3.1v2z" />
    </symbol>
    <symbol id="icon-star" viewBox="0 0 24 24">
      <path fill="currentColor" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2L9.19 8.63L2 9.24l5.46 4.73L5.82 21z" />
    </symbol>
    <symbol id="icon-eye" viewBox="0 0 24 24">
      <path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3z" />
    </symbol>
    <symbol id="icon-eye-off" viewBox="0 0 24 24">
      <path fill="currentColor" d="M12 7c2.76 0 5 2.24 5 5c0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28l.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22L21 20.73L3.27 3L2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65c0 1.66 1.34 3 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53c-2.76 0-5-2.24-5-5c0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15l.02-.16c0-1.66-1.34-3-3-3l-.17.01z" />
    </symbol>
    <symbol id="icon-check" viewBox="0 0 24 24">
      <path fill="currentColor" d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
    </symbol>
    <symbol id="icon-arrow-right" viewBox="0 0 24 24">
      <path fill="currentColor" d="M8.59 16.59L13.17 12L8.59 7.41L10 6l6 6l-6 6l-1.41-1.41z" />
    </symbol>
    <symbol id="icon-arrow-left" viewBox="0 0 24 24">
      <path fill="currentColor" d="M15.41 7.41L14 6l-6 6l6 6l1.41-1.41L10.83 12z" />
    </symbol>
    <symbol id="icon-alert" viewBox="0 0 24 24">
      <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
    </symbol>
  </svg>
</head>

<body class="auth-page" data-page="auth">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-glass">
    <div class="container">
      <a class="navbar-brand fw-bold" href="<?= $base ?>/">
        <svg class="brand-icon me-2" width="32" height="32" fill="currentColor">
          <use href="#icon-star"></use>
        </svg>
        SSM
      </a>
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-outline-light theme-toggle" type="button" data-theme-toggle aria-label="Toggle theme">
          <svg class="icon" width="20" height="20" fill="currentColor">
            <use data-theme-icon href="#icon-sun"></use>
          </svg>
        </button>
        <a class="btn btn-outline-light" href="<?= \Helpers\Url::to('/login') ?>">Login</a>
        <a class="btn btn-primary" href="<?= \Helpers\Url::to('/register') ?>">Register</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="auth-main" id="main-content">
    <div class="container">
      <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <?= $content ?? '' ?>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="auth-footer">
    <div class="container">
      <div class="text-center">
        <p class="text-muted mb-0">© <?= date('Y') ?> Smart Student Monitoring. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    window.__BASE_PATH__ = <?= json_encode($base) ?>;
  </script>
  <script src="<?= \Helpers\Url::asset('app.js') ?>"></script>
  <script src="<?= \Helpers\Url::asset('assets/enhanced-forms.js') ?>"></script>
  <script src="<?= \Helpers\Url::asset('assets/component-library.js') ?>"></script>
  <script src="<?= \Helpers\Url::asset('assets/accessibility.js') ?>"></script>
  <script src="<?= \Helpers\Url::asset('assets/performance.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
