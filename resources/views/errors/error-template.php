<?php
/**
 * Generic Error Page Template
 * Used for 403, 404, 500, and other HTTP errors
 */
$errorCode = $errorCode ?? 500;
$errorTitle = $errorTitle ?? 'Something went wrong';
$errorMessage = $errorMessage ?? 'An unexpected error occurred. Please try again later.';
$errorDescription = $errorDescription ?? 'We apologize for the inconvenience. Our team has been notified and is working to resolve this issue.';
$showHomeButton = $showHomeButton ?? true;
$showContactButton = $showContactButton ?? true;
?>

<div class="error-page">
  <div class="container-fluid container-narrow">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="error-card surface p-4 p-md-5 text-center">
          <!-- Error Code Display -->
          <div class="error-code mb-4">
            <h1 class="display-1 fw-bold text-primary"><?= htmlspecialchars($errorCode) ?></h1>
          </div>
          
          <!-- Error Icon -->
          <div class="error-icon mb-4">
            <?php if ($errorCode == 404): ?>
              <div class="icon-404">🔍</div>
            <?php elseif ($errorCode == 403): ?>
              <div class="icon-403">🚫</div>
            <?php elseif ($errorCode == 500): ?>
              <div class="icon-500">⚠️</div>
            <?php else: ?>
              <div class="icon-generic">❌</div>
            <?php endif; ?>
          </div>
          
          <!-- Error Title -->
          <h2 class="h3 fw-bold mb-3"><?= htmlspecialchars($errorTitle) ?></h2>
          
          <!-- Error Message -->
          <p class="text-muted mb-4"><?= htmlspecialchars($errorMessage) ?></p>
          
          <!-- Error Description -->
          <p class="small text-muted mb-4"><?= htmlspecialchars($errorDescription) ?></p>
          
          <!-- Action Buttons -->
          <div class="error-actions d-flex flex-wrap gap-3 justify-content-center">
            <?php if ($showHomeButton): ?>
              <a href="<?= \Helpers\Url::to('/') ?>" class="btn btn-primary">
                <svg class="icon me-2" aria-hidden="true">
                  <use href="#icon-home"></use>
                </svg>
                Go Home
              </a>
            <?php endif; ?>
            
            <?php if ($showContactButton): ?>
              <a href="<?= \Helpers\Url::to('/contact') ?>" class="btn btn-outline-primary">
                <svg class="icon me-2" aria-hidden="true">
                  <use href="#icon-help"></use>
                </svg>
                Contact Support
              </a>
            <?php endif; ?>
            
            <!-- Back Button -->
            <button onclick="history.back()" class="btn btn-outline-secondary">
              <svg class="icon me-2" aria-hidden="true">
                <use href="#icon-back"></use>
              </svg>
              Go Back
            </button>
          </div>
          
          <!-- Additional Help -->
          <div class="error-help mt-4 pt-4 border-top">
            <p class="small text-muted mb-0">
              If this problem persists, please 
              <a href="<?= \Helpers\Url::to('/contact') ?>" class="text-decoration-none">contact our support team</a>
              with error code <strong><?= htmlspecialchars($errorCode) ?></strong>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.error-page {
  min-height: 60vh;
  display: flex;
  align-items: center;
  padding: 2rem 0;
  background: linear-gradient(180deg, var(--accent-06, rgba(197,112,93,0.06)), transparent 60%);
}

.error-card {
  border-radius: 1rem;
  border: 1px solid var(--color-border);
  background: var(--color-surface);
  box-shadow: var(--shadow-sm);
}

.error-code h1 {
  font-size: 8rem;
  line-height: 1;
  margin: 0;
  background: linear-gradient(135deg, var(--bs-primary), var(--bs-primary-dark));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.error-icon {
  font-size: 4rem;
  opacity: 0.7;
}

.error-icon .icon-404,
.error-icon .icon-403,
.error-icon .icon-500,
.error-icon .icon-generic {
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-10px);
  }
  60% {
    transform: translateY(-5px);
  }
}

.error-actions .btn {
  min-width: 140px;
}

@media (max-width: 768px) {
  .error-code h1 {
    font-size: 6rem;
  }
  
  .error-icon {
    font-size: 3rem;
  }
  
  .error-actions {
    flex-direction: column;
    align-items: center;
  }
  
  .error-actions .btn {
    width: 100%;
    max-width: 300px;
  }
}

/* Dark mode support */
[data-theme="dark"] .error-card {
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .error-help {
  border-color: var(--bs-border-color);
}
</style>
