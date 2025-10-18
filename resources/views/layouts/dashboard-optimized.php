<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Dashboard') ?></title>

  <!-- Skip to content link for accessibility -->
  <a href="#main-content" class="skip-link visually-hidden-focusable">Skip to main content</a>
  
  <?php 
  $base = \Helpers\Url::basePath();
  $assetManager = \App\Helpers\AssetManager::getInstance();
  ?>
  
  <link rel="icon" type="image/svg+xml" href="<?= \Helpers\Url::asset('assets/favicon.svg') ?>">
  
  <!-- Critical CSS (inline for fastest rendering) -->
  <?= $assetManager->renderAssets('dashboard') ?>
  
  <!-- Critical JavaScript (inline for theme) -->
  <script>
    window.__BASE_PATH__ = <?= json_encode($base) ?>;
    (function(){
      try{var p=localStorage.getItem('theme-preference')||'auto';var m=window.matchMedia('(prefers-color-scheme: dark)').matches;var r=p==='auto'?(m?'dark':'light'):p;document.documentElement.setAttribute('data-theme',r==='dark'?'dark':'light');}catch(e){}
    })();
  </script>
  
  <!-- Critical SVG Icons (inline for fastest rendering) -->
  <svg xmlns="http://www.w3.org/2000/svg" style="display:none" aria-hidden="true">
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
    <symbol id="icon-logout" viewBox="0 0 24 24">
      <path fill="currentColor" d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
    </symbol>
  </svg>
</head>

<body>
  <!-- Mobile Toggle Button -->
  <button class="mobile-toggle d-md-none" id="mobileToggle" aria-label="Open sidebar" type="button">
    <span class="mobile-toggle-icon">
      <span></span>
      <span></span>
      <span></span>
    </span>
  </button>

  <!-- Mobile Overlay -->
  <div class="mobile-overlay d-md-none" id="mobileOverlay"></div>

  <div class="dashboard-container">
    <aside class="sidebar" id="sidebar">
      <!-- Sidebar Header -->
      <div class="sidebar-header">
        <div class="sidebar-brand">
          <a href="<?= $base ?>/" class="brand-link">
            <span class="brand-text">SSM</span>
          </a>
        </div>
      </div>

      <!-- User Info -->
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
        $dashboardUrl = \Helpers\Url::to('/' . $userRole);
      ?>
        <div class="sidebar-user">
          <div class="user-info">
            <div class="user-avatar">
              <svg width="32" height="32" fill="currentColor">
                <use href="#<?= $roleIconId ?>"></use>
              </svg>
            </div>
            <div class="user-details">
              <div class="user-name"><?= htmlspecialchars($userName) ?></div>
              <div class="user-role"><?= ucfirst($userRole) ?></div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Navigation -->
      <nav class="sidebar-nav" role="navigation">
        <?php
        $currentPath = $_SERVER['REQUEST_URI'] ?? '/';
        $base = \Helpers\Url::basePath();
        
        if ($user):
          $role = $user['role'];
          $navigation = [];
          
          switch ($role) {
            case 'admin':
              $navigation = [
                ['url' => '/admin', 'label' => 'Dashboard', 'icon' => 'icon-dashboard'],
                ['url' => '/admin/users', 'label' => 'Users', 'icon' => 'icon-user'],
                ['url' => '/admin/sections', 'label' => 'Sections', 'icon' => 'icon-sections'],
                ['url' => '/admin/reports', 'label' => 'Reports', 'icon' => 'icon-report'],
                ['url' => '/admin/settings', 'label' => 'Settings', 'icon' => 'icon-settings']
              ];
              break;
            case 'teacher':
              $navigation = [
                ['url' => '/teacher', 'label' => 'Dashboard', 'icon' => 'icon-dashboard'],
                ['url' => '/teacher/sections', 'label' => 'My Sections', 'icon' => 'icon-sections'],
                ['url' => '/teacher/students', 'label' => 'Students', 'icon' => 'icon-student'],
                ['url' => '/teacher/grades', 'label' => 'Grades', 'icon' => 'icon-chart']
              ];
              break;
            case 'student':
              $navigation = [
                ['url' => '/student', 'label' => 'Dashboard', 'icon' => 'icon-dashboard'],
                ['url' => '/student/grades', 'label' => 'Grades', 'icon' => 'icon-chart'],
                ['url' => '/student/schedule', 'label' => 'Schedule', 'icon' => 'icon-calendar']
              ];
              break;
          }
          
          foreach ($navigation as $item):
            $isActive = str_starts_with($currentPath, $base . $item['url']);
        ?>
          <div class="nav-item">
            <a href="<?= \Helpers\Url::to($item['url']) ?>" class="nav-link <?= $isActive ? 'active' : '' ?>">
              <svg class="nav-icon" width="20" height="20" fill="currentColor">
                <use href="#<?= $item['icon'] ?>"></use>
              </svg>
              <span class="nav-text"><?= htmlspecialchars($item['label']) ?></span>
            </a>
          </div>
        <?php endforeach; endif; ?>
      </nav>

      <!-- Sidebar Footer -->
      <div class="sidebar-footer">
        <form method="post" action="<?= \Helpers\Url::to('/logout') ?>">
          <button class="sidebar-logout" type="submit">
            <svg width="16" height="16" fill="currentColor">
              <use href="#icon-logout"></use>
            </svg>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </aside>

    <div class="main-content">
      <nav class="navbar navbar-glass dashboard-navbar d-flex justify-content-between align-items-center px-4 py-2" role="navigation">
        <div>
          <?php if (($showBack ?? false) === true): ?>
            <a href="<?= $dashboardUrl ?? '#' ?>" class="btn btn-sm btn-outline-secondary">← Back to Dashboard</a>
          <?php endif; ?>
        </div>
        <div>
          <button class="btn btn-outline-secondary theme-toggle" type="button" data-theme-toggle title="Toggle theme" aria-label="Toggle between light and dark theme">
            <svg class="icon" aria-hidden="true">
              <use data-theme-icon href="#icon-sun"></use>
            </svg>
          </button>
        </div>
      </nav>
      <main class="content-area" id="main-content" role="main">
        <?= $content ?? '' ?>
      </main>
    </div>
  </div>
  
  <!-- Performance monitoring script -->
  <script>
    // Basic performance monitoring
    window.addEventListener('load', function() {
      if ('performance' in window) {
        const perfData = performance.getEntriesByType('navigation')[0];
        console.log('🚀 Dashboard load time:', perfData.loadEventEnd - perfData.fetchStart, 'ms');
      }
    });
  </script>
</body>

</html>
