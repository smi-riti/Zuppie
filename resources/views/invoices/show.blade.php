<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            margin: 0;
            padding: 20px;
            color: #333;
            font-size: 14px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background: #fff;
        }
        .header { 
            border-bottom: 2px solid #8B5CF6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-info {
            width: 100%;
            margin-bottom: 20px;
        }
        .company-info td {
            vertical-align: top;
        }
        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .company-details {
            text-align: right;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #8B5CF6;
            margin-bottom: 5px;
        }
        .invoice-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0;
            color: #333;
        }
        .invoice-details {
            width: 100%;
            margin-bottom: 30px;
        }
        .invoice-details td {
            vertical-align: top;
            width: 50%;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .items-table th {
            background-color: #8B5CF6;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        .items-table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #8B5CF6;
        }
        .total-table {
            width: 50%;
            margin-left: auto;
            border-collapse: collapse;
        }
        .total-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #ddd;
        }
        .grand-total {
            font-size: 16px;
            font-weight: bold;
            color: #8B5CF6;
            border-top: 2px solid #8B5CF6;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .gst-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9ff;
            border-left: 4px solid #8B5CF6;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- Header -->
        <div class="header">
            <table class="company-info">
                <tr>
                    <td style="width: 20%;">
                        <img src="{{ public_path('images/logo.jpeg') }}" alt="Zuppie Logo" class="logo">
                    </td>
                    <td style="width: 80%;" class="company-details">
                        <div class="company-name">ZUPPIE</div>
                        <div>Premium Event Management Services</div>
                        <div>123, Business District, Event Plaza</div>
                        <div>Mumbai, Maharashtra - 400001</div>
                        <div>Phone: +91 98765 43210</div>
                        <div>Email: info@zuppie.com</div>
                        <div style="margin-top: 10px; font-weight: bold;">GSTIN: 27AAACH7409R1ZZ</div>
                    </td>
                </tr>
            </table>
            
            <div class="invoice-title">TAX INVOICE</div>
        </div>

        <!-- Invoice Details -->
        <table class="invoice-details">
            <tr>
                <td style="width: 50%;">
                    <div class="section-title">BILL TO:</div>
                    <div><strong>{{ $booking->booking_name ?? $booking->user->name }}</strong></div>
                    @if($booking->booking_email ?? $booking->user->email)
                        <div>{{ $booking->booking_email ?? $booking->user->email }}</div>
                    @endif
                    <div>{{ $booking->booking_phone_no ?? $booking->user->phone_no }}</div>
                    <div>{{ $booking->location }}</div>
                    <div>Pin Code: {{ $booking->pin_code }}</div>
                </td>
                
                <td style="width: 50%;">
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
            @php
                // Calculate GST breakdown (18% total: 9% CGST + 9% SGST)
                $totalWithGst = $booking->total_price;
                $gstRate = 18; // 18% GST for event management services
                $amountBeforeGst = $totalWithGst / (1 + $gstRate/100);
                $gstAmount = $totalWithGst - $amountBeforeGst;
                $cgst = $gstAmount / 2;
                $sgst = $gstAmount / 2;
            @endphp
            
            <table class="total-table">
                <tr>
                    <td>Subtotal (Excluding GST):</td>
                    <td class="text-right">₹ {{ number_format($amountBeforeGst, 2) }}</td>
                </tr>
                <tr>
                    <td>CGST (9%):</td>
                    <td class="text-right">₹ {{ number_format($cgst, 2) }}</td>
                </tr>
                <tr>
                    <td>SGST (9%):</td>
                    <td class="text-right">₹ {{ number_format($sgst, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td><strong>Total Amount:</strong></td>
                    <td class="text-right"><strong>₹ {{ number_format($booking->total_price, 2) }}</strong></td>
                </tr>
            </table>
        </div>

        <!-- Payment Information -->
        @if($booking->payments->count() > 0)
            @php $payment = $booking->payments->first(); @endphp
            <div class="gst-info">
                <strong>Payment Information:</strong><br>
                Payment Method: {{ $payment->payment_method === 'razorpay' ? 'Online Payment (Razorpay)' : 'Cash Payment' }}<br>
                Payment Status: {{ ucfirst($payment->status) }}<br>
                @if($payment->razorpay_payment_id)
                    Transaction ID: {{ $payment->razorpay_payment_id }}<br>
                @endif
                @if($payment->razorpay_order_id)
                    Order ID: {{ $payment->razorpay_order_id }}<br>
                @endif
                Payment Date: {{ $payment->created_at->format('d/m/Y H:i') }}
            </div>
        @else
            <div class="gst-info">
                <strong>Payment Information:</strong><br>
                Payment Method: Cash Payment<br>
                Payment Status: Pending<br>
                Amount Due: ₹ {{ number_format($booking->total_price, 2) }}
            </div>
        @endif

        <!-- Amount in Words -->
        @php
            function numberToWords($number) {
                $ones = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');
                $tens = array('', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety');
                
                if ($number < 20) return $ones[$number];
                if ($number < 100) return $tens[intval($number / 10)] . ' ' . $ones[$number % 10];
                if ($number < 1000) return $ones[intval($number / 100)] . ' hundred ' . numberToWords($number % 100);
                if ($number < 100000) return numberToWords(intval($number / 1000)) . ' thousand ' . numberToWords($number % 1000);
                if ($number < 10000000) return numberToWords(intval($number / 100000)) . ' lakh ' . numberToWords($number % 100000);
                return numberToWords(intval($number / 10000000)) . ' crore ' . numberToWords($number % 10000000);
            }
            $amountInWords = ucfirst(trim(numberToWords(intval($booking->total_price)))) . ' rupees only';
        @endphp
        
        <div style="margin-top: 20px; padding: 10px; background-color: #f0f0f0; border-radius: 5px;">
            <strong>Amount in Words:</strong> {{ $amountInWords }}
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terms & Conditions:</strong></p>
            <p>1. This is a computer-generated invoice and does not require a physical signature.</p>
            <p>2. Payment terms: As per service agreement</p>
            <p>3. All disputes are subject to Mumbai jurisdiction</p>
            <p>4. GST paid on reverse charge basis if applicable</p>
            <p>5. For any queries, please contact us at info@zuppie.com or +91 98765 43210</p>
            <br>
            <p><strong>Thank you for choosing Zuppie - Making your events memorable!</strong></p>
        </div>
    </div>
</body>
</html>