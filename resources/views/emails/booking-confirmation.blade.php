<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .email-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            color: #8B5CF6;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .title {
            color: #1F2937;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .booking-details {
            background: #F3F4F6;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #E5E7EB;
        }
        .detail-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 18px;
            color: #059669;
        }
        .label {
            font-weight: 600;
            color: #374151;
        }
        .value {
            color: #6B7280;
        }
        .payment-info {
            background: linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .payment-method {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #E5E7EB;
        }
        .contact-info {
            background: #FEF3C7;
            border: 1px solid #F59E0B;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-confirmed {
            background: #D1FAE5;
            color: #065F46;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">🎉 Zuppie Events</div>
            <h1 class="title">Booking Confirmation</h1>
            <span class="status-badge status-confirmed">{{ $booking->status }}</span>
        </div>

        <p>Dear {{ $booking->booking_name }},</p>
        
        <p>Thank you for choosing Zuppie Events! Your booking has been confirmed. Here are your booking details:</p>

        <div class="booking-details">
            <h3 style="color: #8B5CF6; margin-top: 0;">📋 Booking Information</h3>
            
            <div class="detail-row">
                <span class="label">Booking ID:</span>
                <span class="value">#{{ $booking->id }}</span>
            </div>
            
            <div class="detail-row">
                <span class="label">Package:</span>
                <span class="value">{{ $booking->eventPackage->name }}</span>
            </div>
            
            <div class="detail-row">
                <span class="label">Event Date:</span>
                <span class="value">{{ \Carbon\Carbon::parse($booking->event_date)->format('l, F j, Y') }}</span>
            </div>
            
            @if($booking->event_time)
            <div class="detail-row">
                <span class="label">Event Time:</span>
                <span class="value">{{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</span>
            </div>
            @endif
            
            @if($booking->event_end_date)
            <div class="detail-row">
                <span class="label">Event End Date:</span>
                <span class="value">{{ \Carbon\Carbon::parse($booking->event_end_date)->format('l, F j, Y') }}</span>
            </div>
            @endif
            
            @if($booking->guest_count)
            <div class="detail-row">
                <span class="label">Guest Count:</span>
                <span class="value">{{ $booking->guest_count }} guests</span>
            </div>
            @endif
            
            <div class="detail-row">
                <span class="label">Location:</span>
                <span class="value">{{ $booking->location }}</span>
            </div>
            
            @if($booking->special_requests)
            <div class="detail-row">
                <span class="label">Special Requests:</span>
                <span class="value">{{ $booking->special_requests }}</span>
            </div>
            @endif
            
            <div class="detail-row">
                <span class="label">Total Amount:</span>
                <span class="value">₹{{ number_format($booking->total_price, 2) }}</span>
            </div>
        </div>

        <div class="payment-info">
            <div class="payment-method">💳 Payment Information</div>
            <p><strong>Payment Method:</strong> {{ ucfirst($booking->payment_method) }}</p>
            
            @if($booking->payment_method === 'cash')
                <p><strong>Advance Amount:</strong> ₹{{ number_format($booking->advance_amount ?? 0, 2) }}</p>
                <p><strong>Due Amount:</strong> ₹{{ number_format($booking->due_amount ?? 0, 2) }}</p>
                <p><small>Note: The due amount will be collected in cash on the event day.</small></p>
            @endif
        </div>

        <div class="contact-info">
            <h4 style="margin-top: 0; color: #D97706;">📞 Need Help?</h4>
            <p>If you have any questions or need to make changes to your booking, please contact us:</p>
            <p><strong>Email:</strong> support@zuppie.com</p>
            <p><strong>Phone:</strong> +91 XXXXX XXXXX</p>
        </div>

        <p>We're excited to make your event special! Our team will contact you soon to discuss the details.</p>

        <div class="footer">
            <p style="color: #6B7280;">Thank you for choosing Zuppie Events!</p>
            <p style="color: #9CA3AF; font-size: 14px;">This is an automated email. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
