<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BookingInvoice extends Controller
{
    public function downloadInvoice($invoiceId)
    {
        // Load the booking with its user, event package, and payments
        $booking = Booking::with(['user', 'eventPackage', 'payments'])->findOrFail($invoiceId);
        
        // Security check - only allow download for confirmed bookings
        if ($booking->status !== 'confirmed') {
            abort(403, 'Invoice not available for this booking status.');
        }
        
        // Additional security: if user is not admin, only allow download of own bookings
        if (!auth()->user() || (auth()->user()->role !== 'admin' && $booking->user_id !== auth()->id())) {
            abort(403, 'Unauthorized access to invoice.');
        }

        // Generate the PDF with proper settings
        $pdf = Pdf::loadView('invoices.show', compact('booking'))
                 ->setPaper('a4', 'portrait')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'DejaVu Sans'
                 ]);

        // Generate filename with invoice number
        $filename = 'Invoice-INV-' . str_pad($invoiceId, 6, '0', STR_PAD_LEFT) . '.pdf';

        // Download the PDF
        return $pdf->download($filename);
    }
}