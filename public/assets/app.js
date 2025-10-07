// Theme persistence and toggle
(function () {
  const STORAGE_KEY = 'theme-preference';
  const getPreference = () => localStorage.getItem(STORAGE_KEY) || 'auto';

  const applyTheme = (theme) => {
    const root = document.documentElement;
    const mediaDark = window.matchMedia('(prefers-color-scheme: dark)');
    const resolved = theme === 'auto' ? (mediaDark.matches ? 'dark' : 'light') : theme;
    root.setAttribute('data-theme', resolved === 'dark' ? 'dark' : 'light');
    document.querySelectorAll('[data-theme-label]').forEach(el => {
      el.textContent = resolved === 'dark' ? 'Dark' : 'Light';
    });
    document.querySelectorAll('[data-theme-icon] use').forEach(use => {
      use.setAttribute('href', resolved === 'dark' ? '#icon-moon' : '#icon-sun');
    });
  };

  const setPreference = (value) => {
    localStorage.setItem(STORAGE_KEY, value);
    applyTheme(value);
  };

  // Initialize
  applyTheme(getPreference());
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    if (getPreference() === 'auto') applyTheme('auto');
  });

  // Wire toggle controls
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-theme-toggle]');
    if (!btn) return;
    const current = getPreference();
    const next = current === 'light' ? 'dark' : current === 'dark' ? 'auto' : 'light';
    setPreference(next);
  });
})();

// Navbar scroll solid background toggle
(function(){
  const nav = document.querySelector('[data-nav]');
  if (!nav) return;
  const onScroll = () => {
    if (window.scrollY > 8) nav.classList.add('is-solid');
    else nav.classList.remove('is-solid');
  };
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });
})();

// Animated counters for stat cards
(function(){
  const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);
  function animateCount(el) {
    const target = parseFloat(el.getAttribute('data-count-to'));
    const duration = parseInt(el.getAttribute('data-count-duration') || '800', 10);
    const decimals = (el.getAttribute('data-count-decimals') || '').length ? parseInt(el.getAttribute('data-count-decimals'), 10) : 0;
    let start = null;
    const initial = 0;
    function step(ts) {
      if (!start) start = ts;
      const progress = Math.min((ts - start) / duration, 1);
      const value = initial + (target - initial) * easeOutCubic(progress);
      el.textContent = value.toFixed(decimals);
      if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }
  function initCounters(root=document) {
    root.querySelectorAll('[data-count-to]').forEach(el => animateCount(el));
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', () => initCounters());
  else initCounters();
})();

// Skeleton loader helper: add class 'skeleton' to placeholder blocks
// Optionally remove after data load by toggling class in page scripts

// Animate progress bars on first paint
(function(){
  function animateProgressBar(bar){
    const to = parseFloat(bar.getAttribute('data-progress-to'));
    if (isNaN(to)) return;
    const duration = parseInt(bar.getAttribute('data-progress-duration') || '800', 10);
    let start = null;
    function step(ts){
      if (!start) start = ts;
      const p = Math.min((ts - start) / duration, 1);
      bar.style.width = (to * p).toFixed(2) + '%';
      if (p < 1) requestAnimationFrame(step);
    }
    // reset to 0 first
    bar.style.width = '0%';
    requestAnimationFrame(step);
  }
  function initProgress(root=document){
    root.querySelectorAll('[data-progress-to]').forEach(animateProgressBar);
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', () => initProgress());
  else initProgress();
})();

// Intersection-based fade-in for .surface and .action-card
(function(){
  const targets = document.querySelectorAll('.surface, .action-card');
  if (!('IntersectionObserver' in window) || targets.length === 0) return;
  targets.forEach(el => { el.style.opacity = '0'; el.style.transform = 'translateY(6px)'; el.style.transition = 'opacity .35s ease, transform .35s ease'; });
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });
  targets.forEach(el => io.observe(el));
})();