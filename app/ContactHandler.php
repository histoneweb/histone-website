<?php
/**
 * Contact Form Handler
 *
 * Handles contact form submissions with validation, spam protection, and database storage
 */

require_once __DIR__ . '/Database.php';

class ContactHandler {
    private $db;
    private $errors = [];
    private $data = [];

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Process contact form submission
     *
     * @return array Response with success/error status
     */
    public function process() {
        // Validate request method
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->error('Invalid request method');
        }

        // Get and sanitize input
        $this->data = [
            'name' => $this->sanitize($_POST['name'] ?? ''),
            'email' => $this->sanitize($_POST['email'] ?? ''),
            'phone' => $this->sanitize($_POST['phone'] ?? ''),
            'company' => $this->sanitize($_POST['company'] ?? ''),
            'project_type' => $_POST['project_type'] ?? 'other',
            'budget_range' => $_POST['budget_range'] ?? 'not_sure',
            'timeline' => $_POST['timeline'] ?? 'flexible',
            'message' => $this->sanitize($_POST['message'] ?? ''),
            'source' => $this->sanitize($_POST['source'] ?? 'website'),
            'subscribed_newsletter' => isset($_POST['subscribe']) ? 1 : 0,
            'honeypot' => $_POST['website'] ?? '', // Spam trap
        ];

        // Validate input
        if (!$this->validate()) {
            return $this->error('Validation failed', $this->errors);
        }

        // Check honeypot (spam protection)
        if (!empty($this->data['honeypot'])) {
            // Log as spam but pretend success
            $this->logSpam();
            return $this->success('Message sent successfully!');
        }

        // Save to database
        try {
            $contactId = $this->saveToDatabase();

            // Send email notification
            $emailSent = $this->sendEmailNotification($contactId);

            // Add to newsletter if requested
            if ($this->data['subscribed_newsletter']) {
                $this->addToNewsletter();
            }

            return $this->success('Thank you! We\'ll get back to you within 24 hours.', [
                'contact_id' => $contactId,
                'email_sent' => $emailSent
            ]);

        } catch (Exception $e) {
            error_log('Contact form error: ' . $e->getMessage());
            return $this->error('An error occurred. Please try again or email us directly.');
        }
    }

    /**
     * Validate form data
     *
     * @return bool
     */
    private function validate() {
        // Name validation
        if (empty($this->data['name'])) {
            $this->errors['name'] = 'Name is required';
        } elseif (strlen($this->data['name']) < 2) {
            $this->errors['name'] = 'Name must be at least 2 characters';
        } elseif (strlen($this->data['name']) > 100) {
            $this->errors['name'] = 'Name is too long';
        }

        // Email validation
        if (empty($this->data['email'])) {
            $this->errors['email'] = 'Email is required';
        } elseif (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email address';
        }

        // Phone validation (optional but validate if provided)
        if (!empty($this->data['phone']) && strlen($this->data['phone']) > 20) {
            $this->errors['phone'] = 'Phone number is too long';
        }

        // Message validation
        if (empty($this->data['message'])) {
            $this->errors['message'] = 'Message is required';
        } elseif (strlen($this->data['message']) < 10) {
            $this->errors['message'] = 'Message must be at least 10 characters';
        } elseif (strlen($this->data['message']) > 5000) {
            $this->errors['message'] = 'Message is too long';
        }

        // Check for spam patterns
        if ($this->containsSpam($this->data['message'])) {
            $this->errors['message'] = 'Your message contains invalid content';
        }

        return empty($this->errors);
    }

    /**
     * Save contact to database
     *
     * @return int Contact ID
     */
    private function saveToDatabase() {
        $sql = "INSERT INTO contacts (
            name, email, phone, company, project_type, budget_range, timeline,
            message, source, subscribed_newsletter, ip_address, user_agent,
            status, priority, created_at
        ) VALUES (
            :name, :email, :phone, :company, :project_type, :budget_range, :timeline,
            :message, :source, :subscribed_newsletter, :ip_address, :user_agent,
            'new', 'medium', NOW()
        )";

        return $this->db->insert($sql, [
            ':name' => $this->data['name'],
            ':email' => $this->data['email'],
            ':phone' => $this->data['phone'],
            ':company' => $this->data['company'],
            ':project_type' => $this->data['project_type'],
            ':budget_range' => $this->data['budget_range'],
            ':timeline' => $this->data['timeline'],
            ':message' => $this->data['message'],
            ':source' => $this->data['source'],
            ':subscribed_newsletter' => $this->data['subscribed_newsletter'],
            ':ip_address' => $this->getIpAddress(),
            ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
    }

    /**
     * Send email notification
     *
     * @param int $contactId
     * @return bool
     */
    private function sendEmailNotification($contactId) {
        // Get site settings
        $settings = $this->getSiteSettings();

        $to = $settings['contact_email'] ?? 'info@histone.com.pk';
        $subject = "New Contact Form Submission - {$this->data['name']}";

        $message = $this->buildEmailMessage($contactId);

        $headers = [
            'From: ' . ($settings['smtp_from_email'] ?? 'noreply@histone.com.pk'),
            'Reply-To: ' . $this->data['email'],
            'X-Mailer: PHP/' . phpversion(),
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8'
        ];

        return mail($to, $subject, $message, implode("\r\n", $headers));
    }

    /**
     * Build email message
     *
     * @param int $contactId
     * @return string
     */
    private function buildEmailMessage($contactId) {
        $projectTypes = [
            'amazon_integration' => 'Amazon Integration',
            'saas_development' => 'SaaS Development',
            'api_development' => 'API Development',
            'ai_integration' => 'AI Integration',
            'consultation' => 'Consultation',
            'other' => 'Other'
        ];

        $budgetRanges = [
            'under_5k' => 'Under $5,000',
            '5k_10k' => '$5,000 - $10,000',
            '10k_25k' => '$10,000 - $25,000',
            '25k_50k' => '$25,000 - $50,000',
            '50k_plus' => '$50,000+',
            'not_sure' => 'Not Sure'
        ];

        $timelines = [
            'urgent' => 'Urgent (ASAP)',
            'within_month' => 'Within a Month',
            'within_3months' => 'Within 3 Months',
            'flexible' => 'Flexible'
        ];

        $projectType = $projectTypes[$this->data['project_type']] ?? 'Other';
        $budget = $budgetRanges[$this->data['budget_range']] ?? 'Not Sure';
        $timeline = $timelines[$this->data['timeline']] ?? 'Flexible';

        return "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #6366f1, #4f46e5); color: white; padding: 20px; border-radius: 8px 8px 0 0; }
                .content { background: #f9fafb; padding: 30px; border-radius: 0 0 8px 8px; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #6366f1; }
                .value { margin-top: 5px; }
                .footer { margin-top: 20px; padding-top: 20px; border-top: 2px solid #e5e7eb; font-size: 12px; color: #6b7280; }
                .badge { display: inline-block; padding: 5px 10px; background: #6366f1; color: white; border-radius: 4px; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>🎯 New Contact Form Submission</h2>
                    <p>Contact ID: #{$contactId}</p>
                </div>
                <div class='content'>
                    <div class='field'>
                        <div class='label'>Name:</div>
                        <div class='value'>{$this->data['name']}</div>
                    </div>

                    <div class='field'>
                        <div class='label'>Email:</div>
                        <div class='value'><a href='mailto:{$this->data['email']}'>{$this->data['email']}</a></div>
                    </div>

                    " . (!empty($this->data['phone']) ? "
                    <div class='field'>
                        <div class='label'>Phone:</div>
                        <div class='value'>{$this->data['phone']}</div>
                    </div>
                    " : "") . "

                    " . (!empty($this->data['company']) ? "
                    <div class='field'>
                        <div class='label'>Company:</div>
                        <div class='value'>{$this->data['company']}</div>
                    </div>
                    " : "") . "

                    <div class='field'>
                        <div class='label'>Project Type:</div>
                        <div class='value'><span class='badge'>{$projectType}</span></div>
                    </div>

                    <div class='field'>
                        <div class='label'>Budget Range:</div>
                        <div class='value'>{$budget}</div>
                    </div>

                    <div class='field'>
                        <div class='label'>Timeline:</div>
                        <div class='value'>{$timeline}</div>
                    </div>

                    <div class='field'>
                        <div class='label'>Message:</div>
                        <div class='value' style='background: white; padding: 15px; border-radius: 4px; border-left: 4px solid #6366f1;'>" . nl2br(htmlspecialchars($this->data['message'])) . "</div>
                    </div>

                    <div class='footer'>
                        <p><strong>Submitted:</strong> " . date('F j, Y \a\t g:i A') . "</p>
                        <p><strong>IP Address:</strong> {$this->getIpAddress()}</p>
                        " . ($this->data['subscribed_newsletter'] ? "<p>✅ <strong>Subscribed to newsletter</strong></p>" : "") . "
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
    }

    /**
     * Add email to newsletter subscribers
     *
     * @return void
     */
    private function addToNewsletter() {
        try {
            $sql = "INSERT INTO email_subscribers (
                email, name, status, subscription_source, subscribed_at, ip_address, user_agent
            ) VALUES (
                :email, :name, 'subscribed', 'contact_form', NOW(), :ip_address, :user_agent
            ) ON DUPLICATE KEY UPDATE
                name = :name,
                status = 'subscribed',
                subscribed_at = NOW()";

            $this->db->execute($sql, [
                ':email' => $this->data['email'],
                ':name' => $this->data['name'],
                ':ip_address' => $this->getIpAddress(),
                ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);
        } catch (Exception $e) {
            error_log('Newsletter subscription error: ' . $e->getMessage());
        }
    }

    /**
     * Get site settings
     *
     * @return array
     */
    private function getSiteSettings() {
        $settings = $this->db->fetchAll("SELECT setting_key, setting_value FROM site_settings");
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting['setting_key']] = $setting['setting_value'];
        }
        return $result;
    }

    /**
     * Log spam submission
     *
     * @return void
     */
    private function logSpam() {
        try {
            $sql = "INSERT INTO contacts (
                name, email, message, ip_address, user_agent, status, created_at
            ) VALUES (
                :name, :email, :message, :ip_address, :user_agent, 'spam', NOW()
            )";

            $this->db->insert($sql, [
                ':name' => $this->data['name'],
                ':email' => $this->data['email'],
                ':message' => $this->data['message'],
                ':ip_address' => $this->getIpAddress(),
                ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);
        } catch (Exception $e) {
            error_log('Spam log error: ' . $e->getMessage());
        }
    }

    /**
     * Check if message contains spam
     *
     * @param string $message
     * @return bool
     */
    private function containsSpam($message) {
        $spamPatterns = [
            '/\[url=/i',
            '/\[link=/i',
            '/<a href=/i',
            '/viagra|cialis|casino|poker|lottery/i',
            '/http.*http.*http/i', // Multiple URLs
        ];

        foreach ($spamPatterns as $pattern) {
            if (preg_match($pattern, $message)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Sanitize input
     *
     * @param string $data
     * @return string
     */
    private function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }

    /**
     * Get client IP address
     *
     * @return string
     */
    private function getIpAddress() {
        $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];

        foreach ($ipKeys as $key) {
            if (isset($_SERVER[$key]) && !empty($_SERVER[$key])) {
                $ip = $_SERVER[$key];
                // Handle multiple IPs (proxy chains)
                if (strpos($ip, ',') !== false) {
                    $ip = explode(',', $ip)[0];
                }
                if (filter_var(trim($ip), FILTER_VALIDATE_IP)) {
                    return trim($ip);
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }

    /**
     * Return success response
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    private function success($message, $data = []) {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
    }

    /**
     * Return error response
     *
     * @param string $message
     * @param array $errors
     * @return array
     */
    private function error($message, $errors = []) {
        return [
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ];
    }
}
