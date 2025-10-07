<!-- Cookie Consent Banner -->
<div id="cookie-consent-banner" class="cookie-consent">
    <div class="cookie-consent-container">
        <div class="cookie-consent-content">
            <h4 class="cookie-consent-title">
                <span class="cookie-icon">🍪</span>
                We Value Your Privacy
            </h4>
            <p class="cookie-consent-text">
                We use cookies to enhance your browsing experience, analyze site traffic, and personalize content.
                By clicking "Accept All", you consent to our use of cookies.
                <a href="{{ route('cookie-policy') }}" target="_blank">Learn more about our Cookie Policy</a>.
            </p>
        </div>
        <div class="cookie-consent-actions">
            <button id="cookie-accept-all" class="cookie-btn cookie-btn-accept">
                Accept All
            </button>
            <button id="cookie-reject-all" class="cookie-btn cookie-btn-reject">
                Reject All
            </button>
            <button id="cookie-customize" class="cookie-btn cookie-btn-customize">
                Customize
            </button>
        </div>
    </div>
</div>

<!-- Cookie Settings Modal -->
<div id="cookie-settings-modal" class="cookie-settings-modal">
    <div class="cookie-settings-content">
        <div class="cookie-settings-header">
            <h3>Cookie Preferences</h3>
            <button id="cookie-settings-close" class="cookie-close-btn" aria-label="Close">×</button>
        </div>

        <div class="cookie-settings-body">
            <p style="color: var(--text-secondary); margin-bottom: var(--spacing-lg); font-size: var(--font-size-sm);">
                Manage your cookie preferences below. You can enable or disable different types of cookies according to your preferences.
            </p>

            <!-- Strictly Necessary Cookies -->
            <div class="cookie-category">
                <div class="cookie-category-header">
                    <h4 class="cookie-category-title">Strictly Necessary Cookies</h4>
                    <label class="cookie-toggle">
                        <input type="checkbox" checked disabled>
                        <span class="cookie-toggle-slider"></span>
                    </label>
                </div>
                <p class="cookie-category-description">
                    These cookies are essential for the website to function properly. They enable core functionality such as security, network management, and accessibility. These cookies cannot be disabled.
                </p>
            </div>

            <!-- Analytics Cookies -->
            <div class="cookie-category">
                <div class="cookie-category-header">
                    <h4 class="cookie-category-title">Performance & Analytics Cookies</h4>
                    <label class="cookie-toggle">
                        <input type="checkbox" id="cookie-analytics">
                        <span class="cookie-toggle-slider"></span>
                    </label>
                </div>
                <p class="cookie-category-description">
                    These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously. This helps us improve our website's performance and content.
                </p>
            </div>

            <!-- Functionality Cookies -->
            <div class="cookie-category">
                <div class="cookie-category-header">
                    <h4 class="cookie-category-title">Functionality Cookies</h4>
                    <label class="cookie-toggle">
                        <input type="checkbox" id="cookie-functionality">
                        <span class="cookie-toggle-slider"></span>
                    </label>
                </div>
                <p class="cookie-category-description">
                    These cookies enable enhanced functionality and personalization, such as remembering your preferences (e.g., theme selection, language). They may be set by us or by third-party providers.
                </p>
            </div>

            <!-- Marketing Cookies -->
            <div class="cookie-category">
                <div class="cookie-category-header">
                    <h4 class="cookie-category-title">Marketing & Targeting Cookies</h4>
                    <label class="cookie-toggle">
                        <input type="checkbox" id="cookie-marketing">
                        <span class="cookie-toggle-slider"></span>
                    </label>
                </div>
                <p class="cookie-category-description">
                    These cookies may be set by our advertising partners to build a profile of your interests and show you relevant ads on other websites. Currently, we do not use marketing cookies.
                </p>
            </div>
        </div>

        <div class="cookie-settings-footer">
            <button id="cookie-save-preferences" class="cookie-btn cookie-btn-accept">
                Save Preferences
            </button>
        </div>
    </div>
</div>

<!-- Cookie Settings Link (shown after consent) -->
<div id="cookie-settings-link" class="cookie-settings-link">
    <span>🍪</span>
    <span>Cookie Settings</span>
</div>
