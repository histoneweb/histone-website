/**
 * Contact Form Handler
 *
 * Handles AJAX form submission with validation and user feedback
 */

class ContactForm {
    constructor(formId) {
        this.form = document.getElementById(formId);
        if (!this.form) {
            console.error(`Form with ID "${formId}" not found`);
            return;
        }

        this.submitButton = this.form.querySelector('button[type="submit"]');
        this.init();
    }

    init() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        // Real-time validation
        this.form.querySelectorAll('input, textarea, select').forEach(field => {
            field.addEventListener('blur', () => this.validateField(field));
            field.addEventListener('input', () => this.clearFieldError(field));
        });
    }

    async handleSubmit(e) {
        e.preventDefault();

        console.log('Form submitted');

        // Validate all fields
        if (!this.validateForm()) {
            console.log('Validation failed');
            return;
        }

        // Disable submit button
        this.setLoading(true);

        // Get form data
        const formData = new FormData(this.form);

        try {
            // Submit via AJAX to Laravel endpoint
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            });

            console.log('Response status:', response.status);
            const result = await response.json();
            console.log('Response data:', result);

            if (response.ok && result.success) {
                console.log('Success! Showing message:', result.message);

                // Clear errors first
                this.clearAllErrors();

                // Reset form
                this.form.reset();

                // Then show success message
                this.showSuccess(result.message);

                // Scroll to success message
                this.scrollToMessage();

                // Track conversion (if analytics available)
                this.trackConversion();
            } else {
                console.log('Error response:', result);
                this.showError(result.message || 'An error occurred');

                // Show field-specific errors
                if (result.errors) {
                    this.showFieldErrors(result.errors);
                }
            }
        } catch (error) {
            console.error('Contact form error:', error);
            this.showError('An error occurred. Please try again or email us directly at info@histone.com.pk');
        } finally {
            this.setLoading(false);
        }
    }

    validateForm() {
        let isValid = true;
        this.clearAllErrors();

        // Get all required fields
        const fields = this.form.querySelectorAll('[required]');

        fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        return isValid;
    }

    validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        let error = '';

        // Required validation
        if (field.hasAttribute('required') && !value) {
            error = 'This field is required';
        }
        // Email validation
        else if (fieldName === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                error = 'Please enter a valid email address';
            }
        }
        // Name validation
        else if (fieldName === 'name' && value) {
            if (value.length < 2) {
                error = 'Name must be at least 2 characters';
            }
        }
        // Message validation
        else if (fieldName === 'message' && value) {
            if (value.length < 10) {
                error = 'Message must be at least 10 characters';
            }
        }

        if (error) {
            this.showFieldError(field, error);
            return false;
        }

        return true;
    }

    showFieldError(field, message) {
        // Remove existing error
        this.clearFieldError(field);

        // Add error class to field
        field.classList.add('error');

        // Create error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.textContent = message;

        // Insert error after field
        field.parentNode.insertBefore(errorDiv, field.nextSibling);
    }

    clearFieldError(field) {
        field.classList.remove('error');

        const errorDiv = field.parentNode.querySelector('.field-error');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    clearAllErrors() {
        this.form.querySelectorAll('.error').forEach(field => {
            field.classList.remove('error');
        });

        this.form.querySelectorAll('.field-error').forEach(error => {
            error.remove();
        });

        // Clear form messages
        const messageDiv = this.form.querySelector('.form-message');
        if (messageDiv) {
            messageDiv.remove();
        }
    }

    showFieldErrors(errors) {
        Object.keys(errors).forEach(fieldName => {
            const field = this.form.querySelector(`[name="${fieldName}"]`);
            if (field) {
                this.showFieldError(field, errors[fieldName]);
            }
        });
    }

    showSuccess(message) {
        this.showMessage(message, 'success');
    }

    showError(message) {
        this.showMessage(message, 'error');
    }

    showMessage(message, type) {
        console.log('showMessage called:', type, message);
        console.log('Form element:', this.form);

        // Remove existing message
        const existingMessage = this.form.querySelector('.form-message');
        if (existingMessage) {
            console.log('Removing existing message');
            existingMessage.remove();
        }

        // Create message element
        const messageDiv = document.createElement('div');
        messageDiv.className = `form-message form-message-${type}`;

        // Enhanced icons with SVG
        const icon = type === 'success'
            ? `<svg class="message-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
               </svg>`
            : `<svg class="message-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
               </svg>`;

        messageDiv.innerHTML = `
            <span class="message-icon">${icon}</span>
            <div class="message-content">
                <strong class="message-title">${type === 'success' ? 'Success!' : 'Error'}</strong>
                <p class="message-text">${message}</p>
            </div>
        `;

        console.log('Message div created:', messageDiv);
        console.log('Form first child:', this.form.firstChild);

        // Insert at top of form (after any text nodes)
        const firstElement = Array.from(this.form.childNodes).find(node => node.nodeType === 1);
        if (firstElement) {
            this.form.insertBefore(messageDiv, firstElement);
        } else {
            this.form.appendChild(messageDiv);
        }

        console.log('Message inserted. Checking if visible...');
        console.log('Message in DOM:', document.querySelector('.form-message'));
        console.log('Message computed style:', window.getComputedStyle(messageDiv));

        // Auto-remove after 6 seconds for success messages
        if (type === 'success') {
            setTimeout(() => {
                messageDiv.style.animation = 'slideOutUp 0.4s ease-out';
                setTimeout(() => messageDiv.remove(), 400);
            }, 6000);
        }
    }

    setLoading(isLoading) {
        if (isLoading) {
            this.submitButton.disabled = true;
            this.submitButton.classList.add('loading');
            this.submitButton.dataset.originalText = this.submitButton.textContent;
            this.submitButton.innerHTML = `
                <span class="spinner"></span>
                <span>Sending...</span>
            `;
        } else {
            this.submitButton.disabled = false;
            this.submitButton.classList.remove('loading');
            this.submitButton.textContent = this.submitButton.dataset.originalText || 'Send Message';
        }
    }

    scrollToMessage() {
        const message = this.form.querySelector('.form-message');
        if (message) {
            message.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    trackConversion() {
        // Google Analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'form_submission', {
                event_category: 'Contact',
                event_label: 'Contact Form'
            });
        }

        // Facebook Pixel
        if (typeof fbq !== 'undefined') {
            fbq('track', 'Contact');
        }

        console.log('Contact form conversion tracked');
    }
}

// Initialize contact form when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new ContactForm('contact-form');
});
