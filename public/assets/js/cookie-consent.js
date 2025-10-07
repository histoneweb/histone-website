// Cookie Consent Management
class CookieConsent {
    constructor() {
        this.consentKey = 'histone_cookie_consent';
        this.preferencesKey = 'histone_cookie_preferences';
        this.init();
    }

    init() {
        // Check if user has already given consent
        const consent = this.getConsent();

        if (!consent) {
            // Show banner after short delay for better UX
            setTimeout(() => this.showBanner(), 1000);
        } else {
            // Apply user preferences
            this.applyPreferences(consent.preferences);
            // Show settings link
            this.showSettingsLink();
        }

        // Setup event listeners
        this.setupEventListeners();
    }

    setupEventListeners() {
        // Accept all button
        const acceptBtn = document.getElementById('cookie-accept-all');
        if (acceptBtn) {
            acceptBtn.addEventListener('click', () => this.acceptAll());
        }

        // Reject all button
        const rejectBtn = document.getElementById('cookie-reject-all');
        if (rejectBtn) {
            rejectBtn.addEventListener('click', () => this.rejectAll());
        }

        // Customize button
        const customizeBtn = document.getElementById('cookie-customize');
        if (customizeBtn) {
            customizeBtn.addEventListener('click', () => this.openSettings());
        }

        // Settings modal close button
        const closeBtn = document.getElementById('cookie-settings-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeSettings());
        }

        // Save preferences button
        const saveBtn = document.getElementById('cookie-save-preferences');
        if (saveBtn) {
            saveBtn.addEventListener('click', () => this.savePreferences());
        }

        // Settings link
        const settingsLink = document.getElementById('cookie-settings-link');
        if (settingsLink) {
            settingsLink.addEventListener('click', () => this.openSettings());
        }

        // Close modal on backdrop click
        const modal = document.getElementById('cookie-settings-modal');
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    this.closeSettings();
                }
            });
        }
    }

    showBanner() {
        const banner = document.getElementById('cookie-consent-banner');
        if (banner) {
            banner.classList.add('show');
        }
    }

    hideBanner() {
        const banner = document.getElementById('cookie-consent-banner');
        if (banner) {
            banner.classList.remove('show');
        }
    }

    showSettingsLink() {
        const link = document.getElementById('cookie-settings-link');
        if (link) {
            link.classList.add('show');
        }
    }

    openSettings() {
        const modal = document.getElementById('cookie-settings-modal');
        if (modal) {
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // Load current preferences
        const consent = this.getConsent();
        if (consent) {
            this.loadPreferences(consent.preferences);
        }
    }

    closeSettings() {
        const modal = document.getElementById('cookie-settings-modal');
        if (modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    acceptAll() {
        const preferences = {
            necessary: true,
            analytics: true,
            functionality: true,
            marketing: false // We don't use marketing cookies yet
        };

        this.saveConsent(preferences);
        this.applyPreferences(preferences);
        this.hideBanner();
        this.showSettingsLink();
    }

    rejectAll() {
        const preferences = {
            necessary: true, // Always required
            analytics: false,
            functionality: false,
            marketing: false
        };

        this.saveConsent(preferences);
        this.applyPreferences(preferences);
        this.hideBanner();
        this.showSettingsLink();
    }

    savePreferences() {
        const preferences = {
            necessary: true, // Always true
            analytics: document.getElementById('cookie-analytics')?.checked || false,
            functionality: document.getElementById('cookie-functionality')?.checked || false,
            marketing: document.getElementById('cookie-marketing')?.checked || false
        };

        this.saveConsent(preferences);
        this.applyPreferences(preferences);
        this.closeSettings();
        this.hideBanner();
        this.showSettingsLink();
    }

    loadPreferences(preferences) {
        // Load preferences into modal checkboxes
        if (document.getElementById('cookie-analytics')) {
            document.getElementById('cookie-analytics').checked = preferences.analytics || false;
        }
        if (document.getElementById('cookie-functionality')) {
            document.getElementById('cookie-functionality').checked = preferences.functionality || false;
        }
        if (document.getElementById('cookie-marketing')) {
            document.getElementById('cookie-marketing').checked = preferences.marketing || false;
        }
    }

    saveConsent(preferences) {
        const consent = {
            timestamp: new Date().toISOString(),
            preferences: preferences
        };

        localStorage.setItem(this.consentKey, JSON.stringify(consent));

        // Also set a cookie for server-side access
        this.setCookie(this.consentKey, JSON.stringify(preferences), 365);
    }

    getConsent() {
        const consent = localStorage.getItem(this.consentKey);
        return consent ? JSON.parse(consent) : null;
    }

    applyPreferences(preferences) {
        // Apply analytics cookies (Google Analytics, etc.)
        if (preferences.analytics) {
            this.enableAnalytics();
        } else {
            this.disableAnalytics();
        }

        // Apply functionality cookies (theme preference, etc.)
        if (preferences.functionality) {
            this.enableFunctionality();
        } else {
            this.disableFunctionality();
        }

        // Apply marketing cookies (if any in future)
        if (preferences.marketing) {
            this.enableMarketing();
        } else {
            this.disableMarketing();
        }
    }

    enableAnalytics() {
        // Enable Google Analytics if configured
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'analytics_storage': 'granted'
            });
        }
        console.log('Analytics cookies enabled');
    }

    disableAnalytics() {
        // Disable Google Analytics
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'analytics_storage': 'denied'
            });
        }
        console.log('Analytics cookies disabled');
    }

    enableFunctionality() {
        // Functionality cookies are already enabled by default (theme preference, etc.)
        console.log('Functionality cookies enabled');
    }

    disableFunctionality() {
        // Note: We keep essential functionality cookies like theme preference
        // even if user rejects, as they enhance user experience
        console.log('Functionality cookies disabled (keeping essential)');
    }

    enableMarketing() {
        // Enable marketing cookies (not currently used)
        console.log('Marketing cookies enabled');
    }

    disableMarketing() {
        // Disable marketing cookies
        console.log('Marketing cookies disabled');
    }

    setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
    }

    getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
}

// Initialize cookie consent when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new CookieConsent();
});
