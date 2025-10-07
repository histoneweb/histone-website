<!-- Theme Switcher -->
<button class="theme-switcher" aria-label="Toggle theme">
    <span class="theme-icon moon" aria-hidden="true">🌙</span>
    <span class="theme-icon sun" aria-hidden="true">☀️</span>
</button>

<!-- Background Effects -->
<div class="bg-animation" aria-hidden="true"></div>
<div class="particles-container" aria-hidden="true">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<!-- Navigation Overlay (Mobile) -->
<div class="nav-overlay"></div>

<!-- Header & Navigation -->
<header class="header">
    <div class="nav-container">
        <a href="./" class="logo">
            <img src="{{ asset('assets/images/logos/footer-logo.png') }}" alt="Histone Solutions" class="logo-img">
        </a>

        <nav role="navigation">
            <ul class="nav-menu">
                <li><a href="#home" class="nav-link">Home</a></li>
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="#portfolio" class="nav-link">Portfolio</a></li>
                <li><a href="#expertise" class="nav-link">Expertise</a></li>
                <li><a href="blog/" class="nav-link" target="_blank" rel="noopener">Blog</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                <li><a href="#contact" class="nav-cta">Get Started</a></li>
            </ul>
        </nav>

        <button class="mobile-menu-toggle" aria-label="Toggle navigation menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
