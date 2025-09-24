<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 15px;
            background: #fce7f3; /* Fallback color */
            background: -webkit-linear-gradient(to right, #ffccd5, #e0c3fc); /* For Safari/Chrome */
            background: -moz-linear-gradient(to right, #ffccd5, #e0c3fc); /* For Firefox */
            background: linear-gradient(to right, #ffccd5, #e0c3fc); /* Standard */
            color: #3c143c;
            font-size: 12px;
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            box-sizing: border-box;
        }
        @media print {
            body {
                background: #fff; /* Fallback for print */
                background: linear-gradient(to right, #ffccd5, #e0c3fc); /* Ensure gradient in print */
                padding: 10mm;
                font-size: 10pt;
                -webkit-print-color-adjust: exact; /* Force background colors */
                print-color-adjust: exact;
            }
            .invoice-box {
                box-shadow: none;
                border: none;
                padding: 10mm;
                max-width: 190mm;
                background: #fff;
            }
            .watermark {
                opacity: 0.05;
            }
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            font-weight: bold;
            color: rgba(219, 39, 119, 0.15);
            text-transform: uppercase;
            letter-spacing: 8px;
            z-index: 0;
            pointer-events: none;
        }
        .invoice-box {
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 2px solid #ec4899;
            border-radius: 12px;
            background: #fff; /* Fallback */
            background: -webkit-linear-gradient(to right, #fef3f8, #f8f0ff); /* For Safari/Chrome */
            background: -moz-linear-gradient(to right, #fef3f8, #f8f0ff); /* For Firefox */
            background: linear-gradient(to right, #fef3f8, #f8f0ff); /* Standard */
            box-shadow: 0 6px 24px rgba(139, 92, 246, 0.25);
            position: relative;
            z-index: 1;
            page-break-after: avoid;
        }
        .header {
            border-bottom: 2px solid #a855f7;
            padding-bottom: 10px;
            margin-bottom: 15px;
            background: #fbcfe8; /* Fallback */
            background: -webkit-linear-gradient(to right, #fbcfe8, #d8b4fe); /* For Safari/Chrome */
            background: -moz-linear-gradient(to right, #fbcfe8, #d8b4fe); /* For Firefox */
            background: linear-gradient(to right, #fbcfe8, #d8b4fe); /* Standard */
            border-radius: 8px;
            padding: 15px;
            transition: transform 0.3s ease;
        }
        .header:hover {
            transform: scale(1.01);
        }
        .company-info {
            width: 100%;
            margin-bottom: 10px;
        }
        .company-info td {
            vertical-align: top;
        }
        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 8px;
            border: 2px solid #f9a8d4;
            transition: box-shadow 0.3s ease;
        }
        .logo:hover {
            box-shadow: 0 0 10px rgba(236, 72, 153, 0.5);
        }
        .company-details {
            text-align: right;
            font-size: 11px;
        }
        .company-name {
            font-size: 22px;
            font-weight: bold;
            color: #9333ea;
            margin-bottom: 5px;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
        }
        .invoice-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #831843;
            margin: 15px 0;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            position: relative;
        }
        .invoice-title::before {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            background: #ec4899;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
        }
        .invoice-details {
            width: 100%;
            margin-bottom: 15px;
        }
        .invoice-details td {
            vertical-align: top;
            width: 50%;
            padding: 8px;
            font-size: 11px;
        }
        .section-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #f9a8d4;
            color: #9333ea;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            background: #fff1f8;
            border-radius: 8px;
            overflow: hidden;
            font-size: 11px;
        }
        .items-table th {
            background: #ec4899; /* Fallback */
            background: -webkit-linear-gradient(to right, #ec4899, #a855f7); /* For Safari/Chrome */
            background: -moz-linear-gradient(to right, #ec4899, #a855f7); /* For Firefox */
            background: linear-gradient(to right, #ec4899, #a855f7); /* Standard */
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #f9a8d4;
        }
        .items-table td {
            padding: 8px;
            border: 1px solid #f9a8d4;
            color: #3c143c;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-section {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px solid #a855f7;
        }
        .total-table {
            width: 50%;
            margin-left: auto;
            border-collapse: collapse;
            background: #f9e8ff; /* Fallback */
            background: -webkit-linear-gradient(to right, #f9e8ff, #fce7f3); /* For Safari/Chrome */
            background: -moz-linear-gradient(to right, #f9e8ff, #fce7f3); /* For Firefox */
            background: linear-gradient(to right, #f9e8ff, #fce7f3); /* Standard */
            border-radius: 6px;
            overflow: hidden;
            font-size: 11px;
        }
        .total-table td {
            padding: 6px 8px;
            border-bottom: 1px solid #f9a8d4;
            color: #3c143c;
        }
        .grand-total {
            font-size: 14px;
            font-weight: bold;
            color: #831843;
            border-top: 2px solid #a855f7;
            background: #fce7f3;
        }
        .gst-info {
            margin-top: 15px;
            padding: 10px;
            background: #f9e8ff; /* Fallback */
            background: -webkit-linear-gradient(to right, #f9e8ff, #fce7f3); /* For Safari/Chrome */
            background: -moz-linear-gradient(to right, #f9e8ff, #fce7f3); /* For Firefox */
            background: linear-gradient(to right, #f9e8ff, #fce7f3); /* Standard */
            border-left: 4px solid #ec4899;
            border-radius: 6px;
            color: #3c143c;
            font-size: 11px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #f9a8d4;
            text-align: center;
            font-size: 10px;
            color: #3c143c;
            background: #fff1f8;
            border-radius: 6px;
            padding: 10px;
        }
        .footer p {
            margin: 3px 0;
        }
    </style>
</head>
<body>
    <div class="watermark">ZUPPIE</div>
    <div class="invoice-box">
        <!-- Header -->
        <div class="header">
            <table class="company-info">
                <tr>
                    <td style="width: 20%;">
                        <img src="{{ public_path('images/zuppie-logo.jpeg') }}" alt="Zuppie Logo" class="logo">
                    </td>
                    <td style="width: 80%;" class="company-details">
                        <div class="company-name">ZUPPIE</div>
                        <div>Premium Event Management Services</div>
                        <div>123, Business District, Event Plaza</div>
                        <div>Mumbai, Maharashtra - 400001</div>
                        <div>Phone: +91 98765 43210</div>
                        <div>Email: info@zuppie.com</div>
                        <div style="margin-top: 8px; font-weight: bold;">GSTIN: 27AAACH7409R1ZZ</div>
                    </td>
                </tr>
            </table>
            <div class="invoice-title">TAX INVOICE</div>
        </div>

        <!-- Invoice Details -->
        <table class="invoice-details">
            <tr>
                <td>
                    <div class="section-title">BILL TO:</div>
                    <div><strong>{{ $booking->booking_name ?? $booking->user->name }}</strong></div>
                    @if($booking->booking_email ?? $booking->user->email)
                        <div>{{ $booking->booking_email ?? $booking->user->email }}</div>
                    @endif
                    <div>{{ $booking->booking_phone_no ?? $booking->user->phone_no }}</div>
                    <div>{{ $booking->location }}</div>
                    <div>Pin Code: {{ $booking->pin_code }}</div>
                </td>
                <td>
                    <div class="section-title">INVOICE DETAILS:</div>
                    <div><strong>Invoice No:</strong> INV-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
                    <div><strong>Date:</strong> {{ now()->format('d/m/Y') }}</div>
                    <div><strong>Event Date:</strong> {{ $booking->event_date->format('d/m/Y') }}</div>
                    @if($booking->event_end_date && $booking->event_end_date != $booking->event_date)
                        <div><strong>Event End Date:</strong> {{ $booking->event_end_date->format('d/m/Y') }}</div>
                    @endif
                    <div><strong>Status:</strong> {{ ucfirst($booking->status) }}</div>
                    @if($booking->guest_count)
                        <div><strong>Guest Count:</strong> {{ $booking->guest_count }}</div>
                    @endif
                </td>
            </tr>
        </table>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Description</th>
                    <th class="text-center" style="width: 15%;">HSN/SAC</th>
                    <th class="text-center" style="width: 10%;">Qty</th>
                    <th class="text-right" style="width: 12.5%;">Rate (₹)</th>
                    <th class="text-right" style="width: 12.5%;">Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $booking->eventPackage->name }}</strong><br>
                        <small>{{ $booking->eventPackage->description ?? 'Event Management & Planning Services' }}</small>
                        @if($booking->special_requests)
                            <br><small><em>Special Requirements: {{ $booking->special_requests }}</em></small>
                        @endif
                    </td>
                    <td class="text-center">9996</td>
                    <td class="text-center">1</td>
                    <td class="text-right">{{ number_format($booking->total_price, 2) }}</td>
                    <td class="text-right">{{ number_format($booking->total_price, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total-section">
            <table class="total-table">
                <tr class="grand-total">
                    <td><strong>Total Amount:</strong></td>
                    <td class="text-right"><strong>₹ {{ number_format($booking->total_price, 2) }}</strong></td>
                </tr>
            </table>
        </div>

        <!-- Payment Information -->
        <div class="gst-info">
            <strong>Payment Information:</strong><br>
            @if($booking->payments->count() > 0)
                @php $payment = $booking->payments->first(); @endphp
                Payment Method: {{ $payment->payment_method === 'razorpay' ? 'Online Payment (Razorpay)' : 'Cash Payment' }}<br>
                Payment Status: {{ ucfirst($payment->status) }}<br>
                @if($payment->razorpay_payment_id)
                    Transaction ID: {{ $payment->razorpay_payment_id }}<br>
                @endif
                @if($payment->razorpay_order_id)
                    Order ID: {{ $payment->razorpay_order_id }}<br>
                @endif
                Payment Date: {{ $payment->created_at->format('d/m/Y H:i') }}
            @else
                Payment Method: Cash Payment<br>
                Payment Status: Pending<br>
                Amount Due: ₹ {{ number_format($booking->total_price, 2) }}
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terms & Conditions:</strong></p>
            <p>1. This is a computer-generated invoice and does not require a physical signature.</p>
            <p>2. Payment terms: As per service agreement</p>
            <p>3. All disputes are subject to Mumbai jurisdiction</p>
            <p>4. GST paid on reverse charge basis if applicable</p>
            <p>5. For any queries, please contact us at info@zuppie.com or +91 98765 43210</p>
            <p><strong>Thank you for choosing Zuppie - Making your events memorable!</strong></p>
        </div>
    </div>
</body>
</html>