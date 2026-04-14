<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; line-height: 1.6; color: #334155; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px; }
        .header { background: #7f1d1d; color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: 700; color: #1e293b; display: block; margin-bottom: 4px; }
        .value { background: #f8fafc; padding: 10px; border-radius: 6px; border-left: 4px solid #7f1d1d; }
        .footer { text-align: center; margin-top: 20px; font-size: 0.8rem; color: #64748b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Support Message</h2>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">From:</span>
                <div class="value">{{ $data['name'] }} ({{ $data['email'] }})</div>
            </div>
            <div class="field">
                <span class="label">Subject:</span>
                <div class="value">{{ $data['subject'] }}</div>
            </div>
            <div class="field">
                <span class="label">Message:</span>
                <div class="value">{!! nl2br(e($data['message'])) !!}</div>
            </div>
        </div>
        <div class="footer">
            Sent from MCC International Guest House Website
        </div>
    </div>
</body>
</html>
