<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Dashboard') ?></title>

  <!-- Skip to content link for accessibility -->
  <a href="#main-content" class="skip-link visually-hidden-focusable">Skip to main content</a>
  <link rel="icon" type="image/svg+xml" href="<?= \Helpers\Url::asset('assets/favicon.svg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('app.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('sidebar-complete.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('chart-fixes.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('assets/accessibility.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('assets/performance.css') ?>" rel="stylesheet">
    <script>
      window.__BASE_PATH__ = <?= json_encode(\Helpers\Url::basePath()) ?>;
      (function(){
        try{var p=localStorage.getItem('theme-preference')||'auto';var m=window.matchMedia('(prefers-color-scheme: dark)').matches;var r=p==='auto'?(m?'dark':'light'):p;document.documentElement.setAttribute('data-theme',r==='dark'?'dark':'light');}catch(e){}
      })();
    </script>
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
      <symbol id="icon-edit" viewBox="0 0 24 24">
        <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
      </symbol>
      <symbol id="icon-delete" viewBox="0 0 24 24">
        <path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
      </symbol>
      <symbol id="icon-filter" viewBox="0 0 24 24">
        <path fill="currentColor" d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
      </symbol>
      <symbol id="icon-search" viewBox="0 0 24 24">
        <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
      </symbol>
      <symbol id="icon-eye" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
      </symbol>
      <symbol id="icon-eye-off" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>
      </symbol>
      <symbol id="icon-check" viewBox="0 0 24 24">
        <path fill="currentColor" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
      </symbol>
      <symbol id="icon-arrow-left" viewBox="0 0 24 24">
        <path fill="currentColor" d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
      </symbol>
      <symbol id="icon-arrow-up" viewBox="0 0 24 24">
        <path fill="currentColor" d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
      </symbol>
      <symbol id="icon-arrow-down" viewBox="0 0 24 24">
        <path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6z"/>
      </symbol>
      <symbol id="icon-more" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
      </symbol>
      <symbol id="icon-download" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
      </symbol>
      <symbol id="icon-settings" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
      </symbol>
      <symbol id="icon-refresh" viewBox="0 0 24 24">
        <path fill="currentColor" d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
      </symbol>
      <symbol id="icon-calendar" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
      </symbol>
      <symbol id="icon-admin" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 9H14V4H5V21H19V9Z"/>
      </symbol>
      <symbol id="icon-teacher" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 9H14V4H5V21H19V9Z"/>
      </symbol>
      <symbol id="icon-adviser" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 9H14V4H5V21H19V9Z"/>
      </symbol>
      <symbol id="icon-student" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 9H14V4H5V21H19V9Z"/>
      </symbol>
      <symbol id="icon-parent" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 9H14V4H5V21H19V9Z"/>
      </symbol>
    </svg>
<?php
  // Ensure user context is available for role-scoped theming
  if (!isset($user) || !is_array($user)) {
    $user = \Core\Session::get('user') ?? [];
  }
  $roleDataAttr = $user['role'] ?? '';
?>
</head>

<body data-role="<?= htmlspecialchars($roleDataAttr) ?>">
  <!-- Mobile Toggle Button -->
  <button class="mobile-toggle d-md-none" id="mobileToggle" aria-label="Open sidebar" type="button">
    <span class="mobile-toggle-icon">
      <span></span>
      <span></span>
      <span></span>
    </span>
  </button>

  <!-- Mobile Overlay -->
  <div class="sidebar-overlay d-md-none" id="sidebarOverlay"></div>

  <div class="dashboard-container">
    <?php $role = $user['role'] ?? '';
    $base = \Helpers\Url::basePath(); ?>
    <?php
    $dashboardUrl = match ($role) {
      'admin' => \Helpers\Url::to('/admin'),
      'teacher' => \Helpers\Url::to('/teacher'),
      'adviser' => \Helpers\Url::to('/adviser'),
      'student' => \Helpers\Url::to('/student'),
      'parent' => \Helpers\Url::to('/parent'),
      default => \Helpers\Url::to('/'),
    };
    ?>
    <aside class="sidebar" id="sidebar" data-accordion="true">
      <!-- Sidebar Header -->
      <div class="sidebar-header">
        <a class="sidebar-brand" href="<?= $dashboardUrl ?>">
          <svg class="sidebar-brand-icon" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          <div>
            <div class="sidebar-brand-text">SSMS</div>
            <div class="sidebar-brand-subtitle"><?= ucfirst($role) ?> Panel</div>
          </div>
        </a>
      </div>

      <!-- User Info -->
      <div class="sidebar-user">
        <div class="sidebar-user-info">
          <div class="sidebar-user-avatar">
            <?php
            $roleIconIds = [
              'admin' => 'icon-admin',
              'teacher' => 'icon-teacher',
              'adviser' => 'icon-adviser',
              'student' => 'icon-student',
              'parent' => 'icon-parent'
            ];
            $roleIconId = $roleIconIds[$role] ?? 'icon-user';
            ?>
            <svg width="20" height="20" fill="currentColor">
              <use href="#<?= $roleIconId ?>"></use>
            </svg>
          </div>
          <div class="sidebar-user-details">
            <div class="sidebar-user-name"><?= htmlspecialchars($user['name'] ?? 'User') ?></div>
            <div class="sidebar-user-role"><?= ucfirst($role) ?></div>
          </div>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="sidebar-nav">
        <?php if (in_array($role, ['teacher'], true)): ?>
          <!-- Dashboard Overview -->
          <a class="nav-link <?= ($activeNav ?? '') === 'dashboard' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher') ?>">
            <svg class="nav-icon" width="20" height="20" fill="currentColor">
              <use href="#icon-dashboard"></use>
            </svg>
            <span>Dashboard</span>
          </a>

          <!-- Teaching Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#teachingCollapse" aria-expanded="true">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-sections"></use>
              </svg>
              <span>Teaching</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse show" id="teachingCollapse">
              <div class="nav-submenu">
                <a class="nav-link <?= ($activeNav ?? '') === 'classes' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher/classes') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-sections"></use>
                  </svg>
                  <span>My Classes</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'grades' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher/grades') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  <span>Grade Management</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'assignments' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher/assignments') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-plus"></use>
                  </svg>
                  <span>Assignments</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'attendance' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher/attendance') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <span>Attendance</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Students Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#studentsCollapse">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-students"></use>
              </svg>
              <span>Students</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse" id="studentsCollapse">
              <div class="nav-submenu">
                <a class="nav-link <?= ($activeNav ?? '') === 'student-progress' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher/student-progress') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-performance"></use>
                  </svg>
                  <span>Student Progress</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'communication' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher/communication') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-message"></use>
                  </svg>
                  <span>Communication</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Resources Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#resourcesCollapse">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-download"></use>
              </svg>
              <span>Resources</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse" id="resourcesCollapse">
              <div class="nav-submenu">
                <a class="nav-link <?= ($activeNav ?? '') === 'materials' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher/materials') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-download"></use>
                  </svg>
                  <span>Teaching Materials</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'alerts' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/teacher/alerts') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-alerts"></use>
                  </svg>
                  <span>Alerts</span>
                </a>
              </div>
            </div>
          </div>
        <?php elseif (in_array($role, ['adviser'], true)): ?>
          <!-- Dashboard Overview -->
          <a class="nav-link <?= ($activeNav ?? '') === 'dashboard' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/adviser') ?>">
            <svg class="nav-icon" width="20" height="20" fill="currentColor">
              <use href="#icon-dashboard"></use>
            </svg>
            <span>Dashboard</span>
          </a>

          <!-- Adviser Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#adviserCollapse" aria-expanded="true">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-sections"></use>
              </svg>
              <span>Advisory</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse show" id="adviserCollapse">
              <div class="nav-submenu">
                <a class="nav-link <?= ($activeNav ?? '') === 'students' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/adviser/students') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-students"></use>
                  </svg>
                  <span>Student Management</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'performance' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/adviser/performance') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-performance"></use>
                  </svg>
                  <span>Performance Tracking</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'communication' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/adviser/communication') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-message"></use>
                  </svg>
                  <span>Communication</span>
                </a>
              </div>
            </div>
          </div>
        <?php elseif ($role === 'admin'): ?>
          <!-- Dashboard Overview -->
          <a class="nav-link <?= ($activeNav ?? '') === 'dashboard' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/admin') ?>">
            <svg class="nav-icon" width="20" height="20" fill="currentColor">
              <use href="#icon-dashboard"></use>
            </svg>
            <span>Dashboard</span>
          </a>

          <!-- User Management Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#userManagementCollapse" aria-expanded="true">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-user"></use>
              </svg>
              <span>User Management</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse show" id="userManagementCollapse">
              <div class="nav-submenu">
                <a class="nav-link <?= ($activeNav ?? '') === 'users' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/admin/users') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                  <span>All Users</span>
                </a>
                <a class="nav-link" href="<?= \Helpers\Url::to('/admin/create-user') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-plus"></use>
                  </svg>
                  <span>Create User</span>
                </a>
                <a class="nav-link" href="<?= \Helpers\Url::to('/admin/create-parent') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-parent"></use>
                  </svg>
                  <span>Create Parent</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-students"></use>
                  </svg>
                  <span>Student Records</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-teachers"></use>
                  </svg>
                  <span>Teacher Records</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Academic Management Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#academicManagementCollapse">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-chart"></use>
              </svg>
              <span>Academic Management</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse" id="academicManagementCollapse">
              <div class="nav-submenu">
                <a class="nav-link" href="<?= \Helpers\Url::to('/grade') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-performance"></use>
                  </svg>
                  <span>Grade Management</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-sections-admin"></use>
                  </svg>
                  <span>Class Sections</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  <span>Subjects</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <span>Academic Calendar</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Reports & Analytics Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#reportsAnalyticsCollapse">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-report"></use>
              </svg>
              <span>Reports & Analytics</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse" id="reportsAnalyticsCollapse">
              <div class="nav-submenu">
                <a class="nav-link" href="<?= \Helpers\Url::to('/admin/reports') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  <span>Analytics Dashboard</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  <span>Academic Reports</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                  <span>User Analytics</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-performance"></use>
                  </svg>
                  <span>Performance Reports</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-download"></use>
                  </svg>
                  <span>Export Data</span>
                </a>
              </div>
            </div>
          </div>

          <!-- System Management Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#systemManagementCollapse">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-settings"></use>
              </svg>
              <span>System Management</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse" id="systemManagementCollapse">
              <div class="nav-submenu">
                <a class="nav-link" href="<?= \Helpers\Url::to('/admin/settings') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-settings"></use>
                  </svg>
                  <span>System Settings</span>
                </a>
                <a class="nav-link" href="<?= \Helpers\Url::to('/admin/logs') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  <span>System Logs</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-download"></use>
                  </svg>
                  <span>Backup & Restore</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-refresh"></use>
                  </svg>
                  <span>Maintenance</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Communication Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#communicationCollapse">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-alerts"></use>
              </svg>
              <span>Communication</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse" id="communicationCollapse">
              <div class="nav-submenu">
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-alerts"></use>
                  </svg>
                  <span>Announcements</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                  <span>Messages</span>
                </a>
                <a class="nav-link" href="#">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-alerts"></use>
                  </svg>
                  <span>Notifications</span>
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if (in_array($role, ['student', 'parent'], true)): ?>
          <!-- Dashboard Overview -->
          <a class="nav-link <?= ($activeNav ?? '') === 'dashboard' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/student') ?>">
            <svg class="nav-icon" width="20" height="20" fill="currentColor">
              <use href="#icon-dashboard"></use>
            </svg>
            <span>Dashboard</span>
          </a>

          <!-- Academic Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#academicCollapse" aria-expanded="true">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-chart"></use>
              </svg>
              <span>Academic</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse show" id="academicCollapse">
              <div class="nav-submenu">
                <a class="nav-link <?= ($activeNav ?? '') === 'grades' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/student/grades') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-performance"></use>
                  </svg>
                  <span>My Grades</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'assignments' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/student/assignments') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-plus"></use>
                  </svg>
                  <span>Assignments</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'attendance' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/student/attendance') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <span>Attendance</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'schedule' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/student/schedule') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <span>Schedule</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Personal Section -->
          <div class="nav-section">
            <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#personalCollapse">
              <svg class="nav-section-icon" width="20" height="20" fill="currentColor">
                <use href="#icon-user"></use>
              </svg>
              <span>Personal</span>
              <svg class="nav-section-arrow" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
            <div class="collapse" id="personalCollapse">
              <div class="nav-submenu">
                <a class="nav-link <?= ($activeNav ?? '') === 'profile' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/student/profile') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                  <span>My Profile</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'alerts' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/student/alerts') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-alerts"></use>
                  </svg>
                  <span>Alerts</span>
                </a>
                <a class="nav-link <?= ($activeNav ?? '') === 'resources' ? 'active' : '' ?>" href="<?= \Helpers\Url::to('/student/resources') ?>">
                  <svg class="nav-icon" width="16" height="16" fill="currentColor">
                    <use href="#icon-download"></use>
                  </svg>
                  <span>Resources</span>
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>
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
            <a href="<?= $dashboardUrl ?>" class="btn btn-sm btn-outline-secondary">← Back to Dashboard</a>
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
  <script src="<?= \Helpers\Url::asset('app.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= \Helpers\Url::asset('assets/accessibility.js') ?>"></script>
  <script src="<?= \Helpers\Url::asset('assets/performance.js') ?>"></script>

  <!-- Include external CSS and JS files -->
  <script src="<?= \Helpers\Url::asset('sidebar-complete.js') ?>"></script>
</body>

</html>