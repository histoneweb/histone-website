<?php
/**
 * Contact Form Test Page
 *
 * Test contact form functionality
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Test - Histone Solutions</title>
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/contact-form.css">
    <style>
        body {
            padding: 2rem;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .test-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .test-header {
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }
        .back-link {
            display: inline-block;
            margin-top: 2rem;
            padding: 1rem 2rem;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
<body data-theme="light">
    <div class="test-container">
        <div class="test-header">
            <h1>🧪 Contact Form Test</h1>
            <p>Test the contact form functionality before going live</p>
        </div>

        <div class="contact-form-wrapper">
            <form id="contact-form" class="contact-form" method="POST" action="api/contact.php">
                <!-- Honeypot for spam protection -->
                <input type="text" name="website" class="form-honeypot" tabindex="-1" autocomplete="off">

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label required">Your Name</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="John Doe" required value="Test User">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label required">Email Address</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="john@company.com" required value="test@example.com">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-input" placeholder="+1 (555) 123-4567" value="+92 300 1234567">
                    </div>

                    <div class="form-group">
                        <label for="company" class="form-label">Company Name</label>
                        <input type="text" id="company" name="company" class="form-input" placeholder="Your Company Inc." value="Test Company Ltd">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="project_type" class="form-label">Project Type</label>
                        <select id="project_type" name="project_type" class="form-select">
                            <option value="other">Select Project Type</option>
                            <option value="amazon_integration">Amazon SP-API Integration</option>
                            <option value="saas_development" selected>SaaS Development</option>
                            <option value="api_development">API Development</option>
                            <option value="ai_integration">AI/ML Integration</option>
                            <option value="consultation">Technical Consultation</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="budget_range" class="form-label">Budget Range</label>
                        <select id="budget_range" name="budget_range" class="form-select">
                            <option value="not_sure">Select Budget Range</option>
                            <option value="under_5k">Under $5,000</option>
                            <option value="5k_10k">$5,000 - $10,000</option>
                            <option value="10k_25k" selected>$10,000 - $25,000</option>
                            <option value="25k_50k">$25,000 - $50,000</option>
                            <option value="50k_plus">$50,000+</option>
                            <option value="not_sure">Not Sure Yet</option>
                        </select>
                    </div>
                </div>

                <div class="form-row full">
                    <div class="form-group">
                        <label for="timeline" class="form-label">Timeline</label>
                        <select id="timeline" name="timeline" class="form-select">
                            <option value="flexible">Select Timeline</option>
                            <option value="urgent">Urgent (ASAP)</option>
                            <option value="within_month" selected>Within a Month</option>
                            <option value="within_3months">Within 3 Months</option>
                            <option value="flexible">Flexible</option>
                        </select>
                    </div>
                </div>

                <div class="form-row full">
                    <div class="form-group">
                        <label for="message" class="form-label required">Tell Us About Your Project</label>
                        <textarea id="message" name="message" class="form-textarea" placeholder="Describe your project requirements..." required>This is a test message to verify the contact form functionality. We want to build a SaaS platform similar to SellerLegend for Amazon sellers.</textarea>
                    </div>
                </div>

                <div class="form-checkbox-group">
                    <input type="checkbox" id="subscribe" name="subscribe" class="form-checkbox" checked>
                    <label for="subscribe" class="checkbox-label">
                        Yes, I'd like to receive updates about new articles and development insights
                    </label>
                </div>

                <button type="submit" class="form-submit">Send Test Message</button>

                <div class="form-footer">
                    This is a test page. Real submissions will be stored in the database.
                </div>
            </form>
        </div>

        <div style="text-align: center;">
            <a href="index.html" class="back-link">← Back to Homepage</a>
            <a href="test-db.php" class="back-link">View Database</a>
        </div>
    </div>

    <script src="assets/js/contact-form.js"></script>
</body>
</html>
