<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply from Histone Solutions</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #6366f1;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 180px;
            height: auto;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
        }
        .reply-content {
            background-color: #f8fafc;
            border-left: 4px solid #6366f1;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .original-message {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        .original-message-header {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .original-message-content {
            background-color: #f1f5f9;
            padding: 15px;
            border-radius: 4px;
            font-size: 14px;
            color: #475569;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
            color: #64748b;
            text-align: center;
        }
        .contact-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 4px;
        }
        .contact-info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .signature {
            margin-top: 30px;
            font-size: 14px;
        }
        .signature strong {
            display: block;
            margin-top: 10px;
            color: #1e293b;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('assets/images/logos/logo-black.png') }}" alt="Histone Solutions" class="logo">
        </div>

        <div class="greeting">
            Hello {{ $submission->name }},
        </div>

        <div class="reply-content">
            {!! nl2br(e($replyMessage)) !!}
        </div>

        <div class="signature">
            Best regards,<br>
            <strong>Histone Solutions Team</strong>
        </div>

        <div class="original-message">
            <div class="original-message-header">
                Your original message:
            </div>
            <div class="original-message-content">
                <p><strong>From:</strong> {{ $submission->name }} ({{ $submission->email }})</p>
                @if($submission->company)
                    <p><strong>Company:</strong> {{ $submission->company }}</p>
                @endif
                @if($submission->service)
                    <p><strong>Service:</strong> {{ $submission->service }}</p>
                @endif
                <p><strong>Date:</strong> {{ $submission->created_at->format('M d, Y H:i') }}</p>
                <hr style="margin: 15px 0; border: none; border-top: 1px solid #cbd5e1;">
                <p>{{ $submission->message }}</p>
            </div>
        </div>

        <div class="contact-info">
            <p><strong>Histone Solutions</strong></p>
            <p>📧 Email: info@histone.com.pk</p>
            <p>🌐 Website: <a href="https://histone.com.pk" style="color: #6366f1; text-decoration: none;">histone.com.pk</a></p>
        </div>

        <div class="footer">
            <p>This is a reply to your inquiry submitted on {{ $submission->created_at->format('M d, Y') }}.</p>
            <p style="font-size: 12px; color: #94a3b8; margin-top: 10px;">
                &copy; {{ date('Y') }} Histone Solutions. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
