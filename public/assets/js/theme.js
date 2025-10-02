/**
 * Theme Switcher
 * Handles dark/light theme toggle and localStorage persistence
 */

(function() {
    'use strict';

    const THEME_KEY = 'histone-theme';
    const THEME_DARK = 'dark';
    const THEME_LIGHT = 'light';

    // Get saved theme or default to dark
    function getSavedTheme() {
        return localStorage.getItem(THEME_KEY) || THEME_DARK;
    }

    // Set theme
    function setTheme(theme) {
        document.body.setAttribute('data-theme', theme);
        localStorage.setItem(THEME_KEY, theme);

        // Dispatch custom event for other scripts to listen to
        const event = new CustomEvent('themeChanged', { detail: { theme } });
        document.dispatchEvent(event);
    }

    // Toggle theme
    function toggleTheme() {
        const currentTheme = document.body.getAttribute('data-theme');
        const newTheme = currentTheme === THEME_DARK ? THEME_LIGHT : THEME_DARK;
        setTheme(newTheme);
    }

    // Initialize theme on page load
    function initializeTheme() {
        const savedTheme = getSavedTheme();
        setTheme(savedTheme);
    }

    // Add event listener to theme switcher button
    function attachEventListeners() {
        const themeSwitcher = document.querySelector('.theme-switcher');
        if (themeSwitcher) {
            themeSwitcher.addEventListener('click', toggleTheme);
        }
    }

    // Detect system theme preference
    function detectSystemTheme() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return THEME_DARK;
        }
        return THEME_LIGHT;
    }

    // Listen for system theme changes
    function watchSystemTheme() {
        if (window.matchMedia) {
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

            mediaQuery.addEventListener('change', (e) => {
                // Only auto-switch if user hasn't manually set a preference
                if (!localStorage.getItem(THEME_KEY)) {
                    setTheme(e.matches ? THEME_DARK : THEME_LIGHT);
                }
            });
        }
    }

    // Public API
    window.ThemeManager = {
        toggle: toggleTheme,
        setTheme: setTheme,
        getTheme: () => document.body.getAttribute('data-theme'),
        THEME_DARK,
        THEME_LIGHT
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initializeTheme();
            attachEventListeners();
            watchSystemTheme();
        });
    } else {
        initializeTheme();
        attachEventListeners();
        watchSystemTheme();
    }

})();
