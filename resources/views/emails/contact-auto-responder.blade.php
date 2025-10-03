<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            background: white;
            padding: 40px 30px;
            border: 1px solid #e5e7eb;
        }
        .highlight-box {
            background: #f3f4f6;
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .footer {
            background: #1f2937;
            color: #9ca3af;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            text-align: center;
            font-size: 0.875rem;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
        h2 {
            color: #1f2937;
            margin-top: 0;
        }
        .services-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        .services-list li {
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .services-list li:before {
            content: "✓ ";
            color: #667eea;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 2rem;">Thank You for Reaching Out!</h1>
        <p style="margin: 15px 0 0 0; opacity: 0.95; font-size: 1.1rem;">Histone Solutions</p>
    </div>

    <div class="content">
        <p>Dear {{ $submission->name }},</p>

        <p>Thank you for contacting <strong>Histone Solutions</strong>. We have received your inquiry and our team will review it shortly.</p>

        <div class="highlight-box">
            <h2>What Happens Next?</h2>
            <p style="margin: 10px 0 0 0;">Our team typically responds within <strong>24-48 hours</strong> during business days. We'll review your requirements and get back to you with a detailed response.</p>
        </div>

        <h2>Our Services</h2>
        <p>While you wait, here's a quick overview of what we offer:</p>

        <ul class="services-list">
            <li><strong>Custom Web Development</strong> - Laravel, PHP, and modern JavaScript frameworks</li>
            <li><strong>Amazon SP-API Integration</strong> - Seamless e-commerce automation</li>
            <li><strong>E-Commerce Solutions</strong> - Complete online store development</li>
            <li><strong>API Development</strong> - RESTful and GraphQL APIs</li>
            <li><strong>Enterprise Solutions</strong> - Scalable applications for growing businesses</li>
        </ul>

        <div class="highlight-box" style="background: #eff6ff; border-left-color: #3b82f6;">
            <p style="margin: 0;"><strong>Quick Tip:</strong> Check out our <a href="{{ config('app.url') }}/blog" style="color: #667eea; text-decoration: none;">blog</a> for insights on web development, Laravel best practices, and Amazon SP-API integration guides.</p>
        </div>

        <p>If you have any urgent questions or additional information to share, feel free to reply to this email.</p>

        <p style="margin-top: 30px;">
            Best regards,<br>
            <strong>The Histone Solutions Team</strong>
        </p>
    </div>

    <div class="footer">
        <p style="margin: 0 0 10px 0;"><strong>Histone Solutions</strong></p>
        <p style="margin: 5px 0;">
            <a href="{{ config('app.url') }}">Website</a> |
            <a href="{{ config('app.url') }}/blog">Blog</a> |
            <a href="{{ config('app.url') }}/#contact">Contact</a>
        </p>
        <p style="margin: 15px 0 0 0; font-size: 0.8rem;">
            This is an automated confirmation email. Please do not reply to this message.
        </p>
    </div>
</body>
</html>
