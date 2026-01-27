<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6; 
            background-color: #f0f2f5;
            padding: 20px;
        }
        .email-container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; 
            padding: 30px; 
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            margin: 8px 0 0 0;
            opacity: 0.95;
            font-size: 14px;
        }
        .content { 
            padding: 35px 30px;
        }
        .info-row {
            display: flex;
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            border-radius: 6px;
        }
        .info-icon {
            width: 30px;
            font-size: 18px;
        }
        .info-content {
            flex: 1;
        }
        .label { 
            font-weight: 600; 
            color: #495057;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .value {
            color: #212529;
            font-size: 15px;
        }
        .message-box {
            background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
            border: 2px solid #bfdbfe;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .message-title {
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 10px;
            font-size: 15px;
        }
        .message-text {
            color: #374151;
            line-height: 1.7;
            font-size: 14px;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer-text {
            color: #6c757d;
            font-size: 12px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🔔 New Contact Message</h1>
            <p>You have received a new inquiry from your website</p>
        </div>
        
        <div class="content">
            <div class="info-row">
                <div class="info-icon">👤</div>
                <div class="info-content">
                    <div class="label">Full Name</div>
                    <div class="value">{{ $data['name'] }}</div>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-icon">📧</div>
                <div class="info-content">
                    <div class="label">Email Address</div>
                    <div class="value">
                        <a href="mailto:{{ $data['email'] }}" style="color: #667eea; text-decoration: none;">
                            {{ $data['email'] }}
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-icon">📱</div>
                <div class="info-content">
                    <div class="label">Phone Number</div>
                    <div class="value">
                        <a href="tel:{{ $data['phone_number'] }}" style="color: #667eea; text-decoration: none;">
                            {{ $data['phone_number'] }}
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-icon">📍</div>
                <div class="info-content">
                    <div class="label">Selected Location</div>
                    <div class="value">{{ $data['selected_address'] }}</div>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-icon">🕐</div>
                <div class="info-content">
                    <div class="label">Preferred Timing</div>
                    <div class="value">{{ $data['selected_timing'] }}</div>
                </div>
            </div>
            
            @if(!empty($data['message']))
            <div class="message-box">
                <div class="message-title">💬 Message from Customer:</div>
                <div class="message-text">{{ $data['message'] }}</div>
            </div>
            @endif
        </div>
        
        <div class="footer">
            <p class="footer-text">This is an automated notification from your Doctor Profile Website</p>
            <p class="footer-text" style="margin-top: 8px;">
                Please respond to the customer as soon as possible
            </p>
        </div>
    </div>
</body>
</html>