<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $booking->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 30px; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td, table th {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .total { font-weight: bold; font-size: 1.2em; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h2>INVOICE</h2>
            <p>#{{ $booking->id }}</p>
        </div>
        
        <div class="details">
            <p><strong>Date:</strong> {{ now()->format('F j, Y') }}</p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="3">Total</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>