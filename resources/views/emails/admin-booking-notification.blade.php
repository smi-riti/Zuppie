<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Received</title>
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
            background: linear-gradient(135deg, #1F2937 0%, #8B5CF6 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .urgent-badge {
            display: inline-block;
            background: #EF4444;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .booking-details {
            background: #F3F4F6;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .customer-info {
            background: #EBF8FF;
            border-left: 4px solid #3B82F6;
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
        }
        .label {
            font-weight: 600;
            color: #374151;
        }
        .value {
            color: #6B7280;
            font-weight: 500;
        }
        .amount-highlight {
            background: #FEF3C7;
            border: 2px solid #F59E0B;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }
        .amount-highlight .total {
            font-size: 24px;
            font-weight: bold;
            color: #D97706;
        }
        .action-buttons {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 0 10px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }
        .btn-primary {
            background: #8B5CF6;
            color: white;
        }
        .btn-secondary {
            background: #6B7280;
            color: white;
        }
        .payment-status {
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .payment-online {
            background: #D1FAE5;
            border: 1px solid #10B981;
            color: #065F46;
        }
        .payment-cash {
            background: #FEF3C7;
            border: 1px solid #F59E0B;
            color: #92400E;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #E5E7EB;
            color: #6B7280;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">🎉 Zuppie Events Admin</div>
            <h1 class="title">New Booking Alert</h1>
            <span class="urgent-badge">Action Required</span>
        </div>

        <p><strong>Hello Admin,</strong></p>
        
        <p>A new booking has been received and requires your attention. Please review the details below:</p>

        <div class="customer-info">
            <h3 style="color: #3B82F6; margin-top: 0;">👤 Customer Information</h3>
            
            <div class="detail-row">
                <span class="label">Customer Name:</span>
                <span class="value">{{ $booking->booking_name }}</span>
            </div>
            
            <div class="detail-row">
                <span class="label">Email:</span>
                <span class="value">{{ $booking->booking_email ?: 'Not provided' }}</span>
            </div>
            
            <div class="detail-row">
                <span class="label">Phone:</span>
                <span class="value">{{ $booking->booking_phone_no }}</span>
            </div>
            
            <div class="detail-row">
                <span class="label">User ID:</span>
                <span class="value">#{{ $user->id }} ({{ $user->name }})</span>
            </div>
        </div>

        <div class="booking-details">
            <h3 style="color: #8B5CF6; margin-top: 0;">📋 Booking Details</h3>
            
            <div class="detail-row">
                <span class="label">Booking ID:</span>
                <span class="value">#{{ $booking->id }}</span>
            </div>
            
            <div class="detail-row">
                <span class="label">Package:</span>
                <span class="value">{{ $booking->eventPackage->name }}</span>
            </div>
            
            <div class="detail-row">
                <span class="label">Booking Date:</span>
                <span class="value">{{ $booking->created_at->format('l, F j, Y g:i A') }}</span>
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
            
            <div class="detail-row">
                <span class="label">Pin Code:</span>
                <span class="value">{{ $booking->pin_code }}</span>
            </div>
            
            @if($booking->special_requests)
            <div class="detail-row">
                <span class="label">Special Requests:</span>
                <span class="value">{{ $booking->special_requests }}</span>
            </div>
            @endif
            
            <div class="detail-row">
                <span class="label">Status:</span>
                <span class="value" style="text-transform: uppercase; font-weight: bold;">{{ $booking->status }}</span>
            </div>
        </div>

        <div class="amount-highlight">
            <div style="font-size: 18px; margin-bottom: 10px;">💰 Revenue Information</div>
            <div class="total">Total: ₹{{ number_format($booking->total_price, 2) }}</div>
        </div>

        @if($booking->payment_method === 'cash')
            <div class="payment-status payment-cash">
                <h4 style="margin-top: 0;">💳 Payment Details - Cash Booking</h4>
                <p><strong>Payment Method:</strong> Cash (with 20% advance online)</p>
                <p><strong>Advance Amount:</strong> ₹{{ number_format($booking->advance_amount ?? 0, 2) }}</p>
                <p><strong>Due Amount:</strong> ₹{{ number_format($booking->due_amount ?? 0, 2) }}</p>
                <p><strong>Advance Status:</strong> {{ $booking->advance_paid ? 'Paid' : 'Pending' }}</p>
                <p><small>⚠️ Remaining amount to be collected in cash on event day</small></p>
            </div>
        @else
            <div class="payment-status payment-online">
                <h4 style="margin-top: 0;">💳 Payment Details - Online Payment</h4>
                <p><strong>Payment Method:</strong> Online</p>
                <p><strong>Amount:</strong> ₹{{ number_format($booking->total_price, 2) }}</p>
                <p>✅ Full payment completed online</p>
            </div>
        @endif

        <div class="action-buttons">
            <a href="{{ url('/admin/bookings/' . $booking->id) }}" class="btn btn-primary">View Booking</a>
            <a href="{{ url('/admin/bookings') }}" class="btn btn-secondary">All Bookings</a>
        </div>

        <div style="background: #FEE2E2; border: 1px solid #EF4444; border-radius: 8px; padding: 15px; margin: 20px 0;">
            <h4 style="color: #DC2626; margin-top: 0;">⚡ Next Steps Required:</h4>
            <ul style="color: #7F1D1D; margin: 0;">
                <li>Contact customer to confirm event details</li>
                <li>Assign event coordinator</li>
                <li>Schedule site visit if required</li>
                @if($booking->payment_method === 'cash' && !$booking->advance_paid)
                    <li><strong>Follow up on advance payment</strong></li>
                @endif
            </ul>
        </div>

        <div class="footer">
            <p>This booking was received on {{ $booking->created_at->format('F j, Y \a\t g:i A') }}</p>
            <p style="font-size: 14px;">Zuppie Events Admin Panel - Automated Notification</p>
        </div>
    </div>
</body>
</html>
