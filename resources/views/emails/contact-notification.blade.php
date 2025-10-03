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
            padding: 30px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }
        .info-block {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .label {
            font-weight: 600;
            color: #667eea;
            margin-bottom: 5px;
        }
        .value {
            color: #1f2937;
            margin-bottom: 15px;
        }
        .footer {
            background: #1f2937;
            color: #9ca3af;
            padding: 20px;
            border-radius: 0 0 8px 8px;
            text-align: center;
            font-size: 0.875rem;
        }
        .btn {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">New Contact Inquiry</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Histone Solutions</p>
    </div>

    <div class="content">
        <p>You have received a new contact inquiry from your website:</p>

        <div class="info-block">
            <div class="label">Name:</div>
            <div class="value">{{ $submission->name }}</div>

            <div class="label">Email:</div>
            <div class="value"><a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a></div>

            @if($submission->company)
            <div class="label">Company:</div>
            <div class="value">{{ $submission->company }}</div>
            @endif

            @if($submission->service)
            <div class="label">Service Interested In:</div>
            <div class="value">{{ $submission->service }}</div>
            @endif

            <div class="label">Message:</div>
            <div class="value" style="white-space: pre-wrap;">{{ $submission->message }}</div>

            @if($submission->ip_address)
            <div class="label">IP Address:</div>
            <div class="value">{{ $submission->ip_address }}</div>
            @endif
        </div>

        <div style="text-align: center;">
            <a href="{{ config('app.url') }}/admin/contact-submissions/{{ $submission->id }}/edit" class="btn">
                View in Admin Panel
            </a>
        </div>

        <p style="color: #6b7280; font-size: 0.875rem; margin-top: 20px;">
            <strong>Submitted:</strong> {{ $submission->created_at->format('F d, Y \a\t g:i A') }}
        </p>
    </div>

    <div class="footer">
        <p style="margin: 0;">This is an automated notification from Histone Solutions</p>
        <p style="margin: 5px 0 0 0;">{{ config('app.url') }}</p>
    </div>
</body>
</html>
