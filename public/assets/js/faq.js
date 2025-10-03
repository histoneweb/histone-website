/**
 * FAQ Accordion
 * Handles click events for FAQ items
 */

class FAQAccordion {
    constructor() {
        this.faqItems = document.querySelectorAll('.faq-item');
        this.init();
    }

    init() {
        this.faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');

            question.addEventListener('click', () => {
                this.toggleItem(item);
            });
        });

        // Open first FAQ by default
        if (this.faqItems.length > 0) {
            this.faqItems[0].classList.add('active');
        }
    }

    toggleItem(item) {
        const isActive = item.classList.contains('active');

        // Close all other items (accordion behavior)
        this.faqItems.forEach(faqItem => {
            if (faqItem !== item) {
                faqItem.classList.remove('active');
            }
        });

        // Toggle current item
        if (isActive) {
            item.classList.remove('active');
        } else {
            item.classList.add('active');
        }
    }
}

// Initialize FAQ accordion when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new FAQAccordion();
});
