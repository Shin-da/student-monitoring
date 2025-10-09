// Advanced Notification/Toast System
class NotificationSystem {
    constructor() {
        this.container = null;
        this.notifications = new Map();
        this.defaultOptions = {
            type: 'info',
            duration: 5000,
            position: 'top-right',
            dismissible: true,
            showProgress: true,
            sound: false,
            vibration: false,
            icon: true,
            animation: 'slideInRight'
        };
        this.init();
    }

    init() {
        this.createContainer();
        this.addStyles();
        this.setupEventListeners();
    }

    createContainer() {
        this.container = document.createElement('div');
        this.container.id = 'notification-container';
        this.container.className = 'notification-container';
        document.body.appendChild(this.container);
    }

    addStyles() {
        if (document.querySelector('#notification-system-styles')) return;

        const style = document.createElement('style');
        style.id = 'notification-system-styles';
        style.textContent = `
            .notification-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 400px;
                width: 100%;
                pointer-events: none;
            }

            .notification {
                background: var(--color-surface);
                border: 1px solid var(--color-border);
                border-radius: var(--radius-md);
                box-shadow: var(--shadow-lg);
                margin-bottom: 12px;
                padding: 16px;
                pointer-events: auto;
                position: relative;
                overflow: hidden;
                transform: translateX(100%);
                opacity: 0;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }

            .notification.show {
                transform: translateX(0);
                opacity: 1;
            }

            .notification.hide {
                transform: translateX(100%);
                opacity: 0;
            }

            .notification-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 8px;
            }

            .notification-icon {
                width: 20px;
                height: 20px;
                margin-right: 8px;
                flex-shrink: 0;
            }

            .notification-title {
                font-weight: 600;
                font-size: 14px;
                color: var(--color-text);
                margin: 0;
                flex: 1;
            }

            .notification-close {
                background: none;
                border: none;
                color: var(--color-muted);
                cursor: pointer;
                padding: 4px;
                border-radius: 4px;
                transition: all 0.2s ease;
                width: 24px;
                height: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .notification-close:hover {
                background: rgba(0, 0, 0, 0.1);
                color: var(--color-text);
            }

            .notification-message {
                font-size: 13px;
                color: var(--color-muted);
                line-height: 1.4;
                margin: 0;
            }

            .notification-progress {
                position: absolute;
                bottom: 0;
                left: 0;
                height: 3px;
                background: currentColor;
                opacity: 0.3;
                transition: width linear;
                border-radius: 0 0 var(--radius-md) var(--radius-md);
            }

            .notification-actions {
                margin-top: 12px;
                display: flex;
                gap: 8px;
                justify-content: flex-end;
            }

            .notification-btn {
                padding: 6px 12px;
                border: none;
                border-radius: 4px;
                font-size: 12px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s ease;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }

            .notification-btn-primary {
                background: var(--color-primary);
                color: white;
            }

            .notification-btn-primary:hover {
                background: #0b5ed7;
                transform: translateY(-1px);
            }

            .notification-btn-secondary {
                background: transparent;
                color: var(--color-muted);
                border: 1px solid var(--color-border);
            }

            .notification-btn-secondary:hover {
                background: var(--color-border);
                color: var(--color-text);
            }

            /* Notification Types */
            .notification-success {
                border-left: 4px solid #198754;
                color: #198754;
            }

            .notification-success .notification-icon {
                color: #198754;
            }

            .notification-error {
                border-left: 4px solid #dc3545;
                color: #dc3545;
            }

            .notification-error .notification-icon {
                color: #dc3545;
            }

            .notification-warning {
                border-left: 4px solid #ffc107;
                color: #b45309;
            }

            .notification-warning .notification-icon {
                color: #b45309;
            }

            .notification-info {
                border-left: 4px solid #0dcaf0;
                color: #0dcaf0;
            }

            .notification-info .notification-icon {
                color: #0dcaf0;
            }

            /* Dark theme adjustments */
            [data-theme="dark"] .notification {
                background: rgba(18, 24, 38, 0.95);
                border-color: rgba(148, 163, 184, 0.2);
            }

            [data-theme="dark"] .notification-close:hover {
                background: rgba(255, 255, 255, 0.1);
            }

            /* Mobile responsiveness */
            @media (max-width: 768px) {
                .notification-container {
                    top: 10px;
                    right: 10px;
                    left: 10px;
                    max-width: none;
                }

                .notification {
                    margin-bottom: 8px;
                    padding: 12px;
                }
            }

            /* Animation variants */
            .notification-slideInRight {
                transform: translateX(100%);
            }

            .notification-slideInRight.show {
                transform: translateX(0);
            }

            .notification-slideInLeft {
                transform: translateX(-100%);
            }

            .notification-slideInLeft.show {
                transform: translateX(0);
            }

            .notification-fadeIn {
                transform: translateY(-20px);
            }

            .notification-fadeIn.show {
                transform: translateY(0);
            }

            .notification-bounceIn {
                transform: scale(0.3);
            }

            .notification-bounceIn.show {
                transform: scale(1);
            }
        `;
        document.head.appendChild(style);
    }

    setupEventListeners() {
        // Handle system notifications
        if ('Notification' in window) {
            Notification.requestPermission();
        }
    }

    show(message, options = {}) {
        const config = { ...this.defaultOptions, ...options };
        const id = this.generateId();
        
        const notification = this.createNotification(id, message, config);
        this.container.appendChild(notification);
        this.notifications.set(id, { element: notification, config });

        // Trigger show animation
        requestAnimationFrame(() => {
            notification.classList.add('show');
        });

        // Auto-dismiss
        if (config.duration > 0) {
            this.scheduleDismiss(id, config.duration);
        }

        // Play sound
        if (config.sound) {
            this.playSound(config.type);
        }

        // Vibrate
        if (config.vibration && 'vibrate' in navigator) {
            navigator.vibrate(200);
        }

        // Show browser notification
        if (config.browserNotification && 'Notification' in window && Notification.permission === 'granted') {
            new Notification(config.title || 'Notification', {
                body: message,
                icon: '/assets/favicon.svg'
            });
        }

        return id;
    }

    createNotification(id, message, config) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${config.type} notification-${config.animation}`;
        notification.setAttribute('data-id', id);

        const icon = this.getIcon(config.type);
        const title = config.title || this.getDefaultTitle(config.type);

        notification.innerHTML = `
            <div class="notification-header">
                <div style="display: flex; align-items: center;">
                    ${config.icon ? `<svg class="notification-icon" width="20" height="20" fill="currentColor">${icon}</svg>` : ''}
                    <h6 class="notification-title">${title}</h6>
                </div>
                ${config.dismissible ? `<button class="notification-close" onclick="notificationSystem.dismiss('${id}')">
                    <svg width="16" height="16" fill="currentColor">
                        <use href="#icon-close"></use>
                    </svg>
                </button>` : ''}
            </div>
            <p class="notification-message">${message}</p>
            ${config.showProgress && config.duration > 0 ? `<div class="notification-progress" style="width: 100%; transition-duration: ${config.duration}ms;"></div>` : ''}
            ${config.actions ? this.createActions(id, config.actions) : ''}
        `;

        // Add click to dismiss
        if (config.clickToDismiss) {
            notification.addEventListener('click', () => this.dismiss(id));
        }

        return notification;
    }

    createActions(id, actions) {
        const actionsHtml = actions.map(action => {
            const className = action.primary ? 'notification-btn-primary' : 'notification-btn-secondary';
            return `<button class="notification-btn ${className}" onclick="${action.handler}('${id}')">${action.text}</button>`;
        }).join('');

        return `<div class="notification-actions">${actionsHtml}</div>`;
    }

    getIcon(type) {
        const icons = {
            success: '<use href="#icon-check"></use>',
            error: '<use href="#icon-alerts"></use>',
            warning: '<use href="#icon-alerts"></use>',
            info: '<use href="#icon-chart"></use>'
        };
        return icons[type] || icons.info;
    }

    getDefaultTitle(type) {
        const titles = {
            success: 'Success',
            error: 'Error',
            warning: 'Warning',
            info: 'Information'
        };
        return titles[type] || 'Notification';
    }

    scheduleDismiss(id, duration) {
        setTimeout(() => {
            this.dismiss(id);
        }, duration);
    }

    dismiss(id) {
        const notification = this.notifications.get(id);
        if (!notification) return;

        const element = notification.element;
        element.classList.remove('show');
        element.classList.add('hide');

        setTimeout(() => {
            if (element.parentNode) {
                element.parentNode.removeChild(element);
            }
            this.notifications.delete(id);
        }, 300);
    }

    dismissAll() {
        this.notifications.forEach((_, id) => {
            this.dismiss(id);
        });
    }

    playSound(type) {
        // Create audio context for sound effects
        if ('AudioContext' in window || 'webkitAudioContext' in window) {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);

            const frequencies = {
                success: 800,
                error: 400,
                warning: 600,
                info: 500
            };

            oscillator.frequency.setValueAtTime(frequencies[type] || 500, audioContext.currentTime);
            oscillator.type = 'sine';

            gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.2);

            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.2);
        }
    }

    generateId() {
        return 'notification_' + Math.random().toString(36).substr(2, 9);
    }

    // Convenience methods
    success(message, options = {}) {
        return this.show(message, { ...options, type: 'success' });
    }

    error(message, options = {}) {
        return this.show(message, { ...options, type: 'error' });
    }

    warning(message, options = {}) {
        return this.show(message, { ...options, type: 'warning' });
    }

    info(message, options = {}) {
        return this.show(message, { ...options, type: 'info' });
    }

    // Loading notification
    loading(message = 'Loading...', options = {}) {
        return this.show(message, {
            ...options,
            type: 'info',
            duration: 0,
            dismissible: false,
            showProgress: false,
            icon: false
        });
    }

    // Update loading notification
    updateLoading(id, message, type = 'success') {
        const notification = this.notifications.get(id);
        if (!notification) return;

        const messageEl = notification.element.querySelector('.notification-message');
        const iconEl = notification.element.querySelector('.notification-icon');
        const titleEl = notification.element.querySelector('.notification-title');

        if (messageEl) messageEl.textContent = message;
        if (iconEl) iconEl.innerHTML = this.getIcon(type);
        if (titleEl) titleEl.textContent = this.getDefaultTitle(type);

        // Update notification class
        notification.element.className = notification.element.className.replace(/notification-\w+/, `notification-${type}`);

        // Auto-dismiss after update
        setTimeout(() => {
            this.dismiss(id);
        }, 3000);
    }
}

// Add missing close icon to SVG sprite
if (!document.querySelector('#icon-close')) {
    const svg = document.querySelector('svg[style="display:none"]');
    if (svg) {
        const closeIcon = document.createElement('symbol');
        closeIcon.id = 'icon-close';
        closeIcon.setAttribute('viewBox', '0 0 24 24');
        closeIcon.innerHTML = '<path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>';
        svg.appendChild(closeIcon);
    }
}

// Initialize global notification system
window.notificationSystem = new NotificationSystem();

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = NotificationSystem;
}
