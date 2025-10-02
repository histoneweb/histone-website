/**
 * Testimonial Slider
 * Handles testimonial carousel with auto-play and navigation
 */

(function() {
    'use strict';

    class TestimonialSlider {
        constructor(container) {
            this.container = container;
            this.track = container.querySelector('.testimonial-track');
            this.slides = container.querySelectorAll('.testimonial-slide');
            this.prevBtn = container.querySelector('.slider-prev');
            this.nextBtn = container.querySelector('.slider-next');
            this.dotsContainer = container.querySelector('.slider-dots');

            this.currentIndex = 0;
            this.slideCount = this.slides.length;
            this.autoPlayInterval = null;
            this.autoPlayDelay = 5000; // 5 seconds

            if (this.slideCount > 0) {
                this.init();
            }
        }

        init() {
            this.createDots();
            this.attachEventListeners();
            this.updateSlider();
            this.startAutoPlay();
        }

        createDots() {
            if (!this.dotsContainer) return;

            this.dotsContainer.innerHTML = '';

            for (let i = 0; i < this.slideCount; i++) {
                const dot = document.createElement('button');
                dot.classList.add('slider-dot');
                dot.setAttribute('aria-label', `Go to testimonial ${i + 1}`);
                dot.addEventListener('click', () => this.goToSlide(i));
                this.dotsContainer.appendChild(dot);
            }
        }

        attachEventListeners() {
            if (this.prevBtn) {
                this.prevBtn.addEventListener('click', () => this.prevSlide());
            }

            if (this.nextBtn) {
                this.nextBtn.addEventListener('click', () => this.nextSlide());
            }

            // Pause on hover
            this.container.addEventListener('mouseenter', () => this.stopAutoPlay());
            this.container.addEventListener('mouseleave', () => this.startAutoPlay());

            // Touch events for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            this.container.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
                this.stopAutoPlay();
            });

            this.container.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe(touchStartX, touchEndX);
                this.startAutoPlay();
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (this.container.matches(':hover')) {
                    if (e.key === 'ArrowLeft') {
                        this.prevSlide();
                    } else if (e.key === 'ArrowRight') {
                        this.nextSlide();
                    }
                }
            });
        }

        handleSwipe(startX, endX) {
            const threshold = 50;
            const diff = startX - endX;

            if (Math.abs(diff) > threshold) {
                if (diff > 0) {
                    this.nextSlide();
                } else {
                    this.prevSlide();
                }
            }
        }

        updateSlider() {
            // Update track position
            const translateX = -this.currentIndex * 100;
            this.track.style.transform = `translateX(${translateX}%)`;

            // Update dots
            if (this.dotsContainer) {
                const dots = this.dotsContainer.querySelectorAll('.slider-dot');
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === this.currentIndex);
                });
            }

            // Update button states
            if (this.prevBtn) {
                this.prevBtn.disabled = this.currentIndex === 0;
            }

            if (this.nextBtn) {
                this.nextBtn.disabled = this.currentIndex === this.slideCount - 1;
            }

            // Announce to screen readers
            this.announceSlide();
        }

        announceSlide() {
            const announcement = `Testimonial ${this.currentIndex + 1} of ${this.slideCount}`;
            const liveRegion = document.getElementById('slider-live-region');

            if (liveRegion) {
                liveRegion.textContent = announcement;
            }
        }

        nextSlide() {
            this.currentIndex = (this.currentIndex + 1) % this.slideCount;
            this.updateSlider();
        }

        prevSlide() {
            this.currentIndex = (this.currentIndex - 1 + this.slideCount) % this.slideCount;
            this.updateSlider();
        }

        goToSlide(index) {
            this.currentIndex = index;
            this.updateSlider();
        }

        startAutoPlay() {
            this.stopAutoPlay();

            if (this.slideCount > 1) {
                this.autoPlayInterval = setInterval(() => {
                    this.nextSlide();
                }, this.autoPlayDelay);
            }
        }

        stopAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
                this.autoPlayInterval = null;
            }
        }

        destroy() {
            this.stopAutoPlay();
        }
    }

    // Initialize all testimonial sliders
    function initTestimonialSliders() {
        const sliders = document.querySelectorAll('.testimonial-slider');
        const instances = [];

        sliders.forEach(slider => {
            instances.push(new TestimonialSlider(slider));
        });

        // Create live region for accessibility
        if (sliders.length > 0 && !document.getElementById('slider-live-region')) {
            const liveRegion = document.createElement('div');
            liveRegion.id = 'slider-live-region';
            liveRegion.setAttribute('aria-live', 'polite');
            liveRegion.setAttribute('aria-atomic', 'true');
            liveRegion.style.position = 'absolute';
            liveRegion.style.left = '-10000px';
            liveRegion.style.width = '1px';
            liveRegion.style.height = '1px';
            liveRegion.style.overflow = 'hidden';
            document.body.appendChild(liveRegion);
        }

        return instances;
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTestimonialSliders);
    } else {
        initTestimonialSliders();
    }

    // Export for external use if needed
    window.TestimonialSlider = TestimonialSlider;

})();
