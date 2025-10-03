/**
 * Testimonial Slider - Horizontal Scroll Version
 * Netflix-style horizontal scrolling with smooth navigation
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
            this.autoScrollInterval = null;
            this.autoScrollDelay = 4000; // 4 seconds
            this.isLargeScreen = window.innerWidth >= 1024;

            if (this.slideCount > 0) {
                this.init();
            }
        }

        init() {
            this.createDots();
            this.attachEventListeners();
            this.updateButtons();
            this.startAutoScroll();
        }

        createDots() {
            if (!this.dotsContainer) return;
            this.dotsContainer.innerHTML = '';

            for (let i = 0; i < this.slideCount; i++) {
                const dot = document.createElement('button');
                dot.classList.add('slider-dot');
                dot.setAttribute('aria-label', `Go to testimonial ${i + 1}`);
                dot.addEventListener('click', () => this.scrollToSlide(i));
                this.dotsContainer.appendChild(dot);
            }
        }

        attachEventListeners() {
            // Navigation buttons
            if (this.prevBtn) {
                this.prevBtn.addEventListener('click', () => this.scrollPrev());
            }

            if (this.nextBtn) {
                this.nextBtn.addEventListener('click', () => this.scrollNext());
            }

            // Track scroll events to update dots and buttons
            this.track.addEventListener('scroll', () => {
                this.updateCurrentIndex();
                this.updateButtons();
                this.updateDots();
            });

            // Pause auto-scroll on hover
            this.container.addEventListener('mouseenter', () => this.stopAutoScroll());
            this.container.addEventListener('mouseleave', () => this.startAutoScroll());

            // Handle window resize
            window.addEventListener('resize', () => {
                this.isLargeScreen = window.innerWidth >= 1024;
                this.updateButtons();
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (this.container.matches(':hover')) {
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        this.scrollPrev();
                    } else if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        this.scrollNext();
                    }
                }
            });

            // Mouse wheel horizontal scroll
            this.track.addEventListener('wheel', (e) => {
                if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
                    e.preventDefault();
                    this.track.scrollLeft += e.deltaY;
                }
            }, { passive: false });
        }

        updateCurrentIndex() {
            // Calculate current slide based on scroll position
            const scrollLeft = this.track.scrollLeft;
            const slideWidth = this.slides[0].offsetWidth + 32; // 32px gap (2rem)
            this.currentIndex = Math.round(scrollLeft / slideWidth);
        }

        updateButtons() {
            if (!this.prevBtn || !this.nextBtn) return;

            const scrollLeft = this.track.scrollLeft;
            const maxScroll = this.track.scrollWidth - this.track.clientWidth;

            // Disable prev button at start
            this.prevBtn.disabled = scrollLeft <= 10;

            // Disable next button at end
            this.nextBtn.disabled = scrollLeft >= maxScroll - 10;
        }

        updateDots() {
            if (!this.dotsContainer) return;

            const dots = this.dotsContainer.querySelectorAll('.slider-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === this.currentIndex);
            });
        }

        scrollToSlide(index) {
            const slideWidth = this.slides[0].offsetWidth + 32; // Include gap
            const scrollPosition = index * slideWidth;

            this.track.scrollTo({
                left: scrollPosition,
                behavior: 'smooth'
            });

            this.currentIndex = index;
        }

        scrollNext() {
            if (this.isLargeScreen) {
                // On large screens, scroll by viewport width to show next set of cards
                this.track.scrollBy({
                    left: this.track.clientWidth,
                    behavior: 'smooth'
                });
            } else {
                // On mobile, scroll to next slide
                const nextIndex = Math.min(this.currentIndex + 1, this.slideCount - 1);
                this.scrollToSlide(nextIndex);
            }
        }

        scrollPrev() {
            if (this.isLargeScreen) {
                // On large screens, scroll by viewport width to show previous set of cards
                this.track.scrollBy({
                    left: -this.track.clientWidth,
                    behavior: 'smooth'
                });
            } else {
                // On mobile, scroll to previous slide
                const prevIndex = Math.max(this.currentIndex - 1, 0);
                this.scrollToSlide(prevIndex);
            }
        }

        startAutoScroll() {
            this.stopAutoScroll();

            if (this.slideCount > 1) {
                this.autoScrollInterval = setInterval(() => {
                    const maxScroll = this.track.scrollWidth - this.track.clientWidth;

                    // If at the end, scroll back to start
                    if (this.track.scrollLeft >= maxScroll - 10) {
                        this.track.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                    } else {
                        this.scrollNext();
                    }
                }, this.autoScrollDelay);
            }
        }

        stopAutoScroll() {
            if (this.autoScrollInterval) {
                clearInterval(this.autoScrollInterval);
                this.autoScrollInterval = null;
            }
        }

        destroy() {
            this.stopAutoScroll();
        }
    }

    // Initialize all testimonial sliders
    function initTestimonialSliders() {
        const sliders = document.querySelectorAll('.testimonial-slider');
        const instances = [];

        sliders.forEach(slider => {
            instances.push(new TestimonialSlider(slider));
        });

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
