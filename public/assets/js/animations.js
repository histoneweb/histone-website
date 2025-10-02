/**
 * Animations & Scroll Effects
 * Handles reveal animations, counters, and visual effects
 */

(function() {
    'use strict';

    // Reveal on scroll
    function initRevealOnScroll() {
        const reveals = document.querySelectorAll('.reveal');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        reveals.forEach(reveal => {
            revealObserver.observe(reveal);
        });
    }

    // Animated counter
    function animateCounter(element, start, end, duration, suffix = '') {
        let startTimestamp = null;
        const prefix = element.dataset.prefix || '';

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);

            element.textContent = prefix + value.toLocaleString() + suffix;

            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };

        window.requestAnimationFrame(step);
    }

    // Initialize stat counters
    function initStatCounters() {
        const statNumbers = document.querySelectorAll('.stat-number');

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.animated) {
                    const text = entry.target.textContent;
                    let endValue = 0;
                    let suffix = '';
                    let prefix = '';

                    // Parse different stat formats
                    if (text.includes('K+')) {
                        endValue = parseInt(text.replace(/\D/g, ''));
                        suffix = 'K+';
                        if (text.includes('$')) prefix = '$';
                        entry.target.dataset.prefix = prefix;
                        animateCounter(entry.target, 0, endValue, 2000, suffix);
                    } else if (text.includes('%')) {
                        endValue = parseInt(text.replace(/\D/g, ''));
                        suffix = '%';
                        animateCounter(entry.target, 0, endValue, 2000, suffix);
                    } else if (text.includes('+')) {
                        endValue = parseInt(text.replace(/\D/g, ''));
                        suffix = '+';
                        animateCounter(entry.target, 0, endValue, 2000, suffix);
                    } else if (text.includes('$')) {
                        endValue = parseInt(text.replace(/\D/g, ''));
                        prefix = '$';
                        entry.target.dataset.prefix = prefix;
                        animateCounter(entry.target, 0, endValue, 2000, '');
                    } else {
                        // Default number animation
                        endValue = parseInt(text.replace(/\D/g, '')) || 0;
                        animateCounter(entry.target, 0, endValue, 2000, '');
                    }

                    entry.target.animated = true;
                }
            });
        }, {
            threshold: 0.5
        });

        statNumbers.forEach(stat => {
            counterObserver.observe(stat);
        });
    }

    // Parallax effect for background elements
    function initParallax() {
        const particles = document.querySelectorAll('.particle');

        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;

            particles.forEach((particle, index) => {
                const speed = 0.5 + (index * 0.1);
                const yPos = -(scrolled * speed);
                particle.style.transform = `translateY(${yPos}px)`;
            });
        });
    }

    // Initialize all animations
    function init() {
        initRevealOnScroll();
        initStatCounters();
        initParallax();
    }

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
